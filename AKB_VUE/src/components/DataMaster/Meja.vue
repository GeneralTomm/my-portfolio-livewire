<template>
<v-main class="list">
<h3 class="text-h3 font-weight-medium mb-5"> Meja </h3>

<v-card class="grey lighten-5">
    <v-card-title>
    <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
    ></v-text-field>
    <v-spacer></v-spacer>
    <v-btn color="success" dark @click="dialog = true">
        Tambah
    </v-btn>
        </v-card-title>
            <v-container fluid>
    <v-data-iterator
      :items="mejas"
      item-key="no_meja"
      :items-per-page="50"
      hide-default-footer
      :search="search"
      sort-by="no_meja"
    >
      <template v-slot:default="{ items}">
        <v-row>
          <v-col
            v-for="item in items"
            :key="item.no_meja"
            cols="8"
            sm="8"
            md="8"
            lg="2"
          >
            <v-card @click="editHandler(item)" v-if="item.status_meja == 'not available'" color="red" class="meja1">
              <v-card-title>
                <h4 class="nomeja">{{ item.no_meja }}</h4>
              </v-card-title>
              <v-divider></v-divider>
            </v-card>
            <v-card @click="editHandler(item)" v-if="item.status_meja == 'available'" color="green" class="meja1">
              <v-card-title>
                <h4 class="nomeja">{{ item.no_meja }}</h4>
              </v-card-title>
              <v-divider></v-divider>
            </v-card>
          </v-col>
        </v-row>
      </template>
    </v-data-iterator>
  </v-container>
</v-card>

<v-dialog v-model="dialog" persistent max-width="600px">
    <v-card>
        <v-card-title>
            <span class="headline">{{ formTitle }} Meja</span>
        </v-card-title>
        <v-card-text>
            <v-container>
                <v-text-field
                    v-model="formMeja.no_meja"
                    label="No Meja"
                    :rules="[v => !!v || 'Nomor Meja tidak boleh kosong']"
                    required
                ></v-text-field>

                <v-select
                    v-model="formMeja.status_meja"
                    label="Status Meja"
                    :items ="['not available', 'available']"
                    :rules="[v => !!v || 'Status Meja tidak boleh kosong']"
                    required
                ></v-select>
            </v-container>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="cancel">
                Cancel
            </v-btn>
            <v-btn color="blue darken-1" text @click="setForm">
                Save
            </v-btn>
            <v-btn color="blue darken-1" text @click="dialogConfirm = true">
                Delete
            </v-btn>
        </v-card-actions>
    </v-card>
</v-dialog>

<v-dialog v-model="dialogConfirm" persistent max-width="400px">
      <v-card>
        <v-card-title>
          <span class="headline">warning!</span>
        </v-card-title>
        <v-card-text>
          Anda yakin ingin menghapus meja ini?
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialogConfirm = false">
            Cancel
          </v-btn>
          <v-btn color="blue darken-1" text @click="deleteData">
            Delete
          </v-btn>
        </v-card-actions>
      </v-card>
</v-dialog>

<v-snackbar v-model="snackbar" :color="color" timeout="2000" bottom>
    {{error_message}}
</v-snackbar>

</v-main>
</template>
<script>
export default {
    name: "List",
    data() {
        return {
            inputType: 'Tambah',
            load: false,
            snackbar: false,
            error_message: '',
            color: '',
            search: null,
            dialog: false,
            dialogConfirm: false,

            meja: new FormData,
            mejas: [],
            formMeja: {
                no_meja: null,
                status_meja: null
            },
            deleteId: '',
            editId: '',
        };
    },
    methods: {
        setForm() {
            if (this.inputType === 'Tambah') {
                this.save()
            } else {
                this.update()
            }
        },
        //read data Meja
        readData() {
            var url = this.$api + '/meja'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.mejas = response.data.data
            })
        },
        //simpan data meja
        save() {
            this.meja.append('no_meja', this.formMeja.no_meja);
            this.meja.append('status_meja', this.formMeja.status_meja);

            var url = this.$api + '/meja'
            this.load = true
            this.$http.post(url, this.meja, {
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load = false;
                this.close();
                this.readData(); //mengambil data
                this.resetForm();
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            })
        },
        //ubah data meja
        update() {
            let newData = {
                'no_meja': this.formMeja.no_meja,
                'status_meja': this.formMeja.status_meja
            }
            var url = this.$api + '/meja/' + this.editId;
            this.load = true
            this.$http.put(url, newData, {
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load = false;
                this.close();
                this.readData(); //mengambil data
                this.resetForm();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            }) 
        },

    deleteData() {
            var url = this.$api + '/meja/' + this.editId;
            this.load = true
            this.$http.delete(url,{
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load = false;
                this.close();
                this.readData(); //mengambil data
                this.resetForm();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            }) 
        },
        
        editHandler(item){
            this.inputType = 'Ubah';
            this.editId = item.id_meja;
            this.formMeja.no_meja = item.no_meja;
            this.formMeja.status_meja = item.status_meja;
            this.dialog = true;
        },
        deleteHandler(id_meja){
            this.deleteId = id_meja;
            this.dialogConfirm = true;
        },
        close() {
            this.resetForm();
            this.readData();
            this.dialog = false
            this.dialogConfirm = false
            this.inputType = 'Tambah';
        },
        cancel() {
            this.resetForm();
            this.readData();
            this.dialog = false;
            this.inputType = 'Tambah';
        },
        resetForm() {
            this.formMeja = {
                no_meja: null,
                status_meja: null,
            };
        },
    },
    computed: {
        formTitle() {
            return this.inputType 
        },
    },
    mounted() {
        this.readData();
    },
};
</script>

<style scoped>
    .meja1{
        width:4cm;
        height: 2cm;
        
    }
    .nomeja{
        font-size: 30px;
        position: relative;
        left: 1.2cm;
    }
</style>