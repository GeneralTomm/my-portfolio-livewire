<!-- @format -->
  
<template>
<v-main class="list">
<h3 class="text-h3 font-weight-medium mb-5"> Bahan </h3>

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
    <v-btn color="success" dark @click="dialog = true" v-if="haveAccess()==1">
        Tambah
    </v-btn>
        </v-card-title>
            <v-data-table :headers="headers" :items="Bahans" :search="search" class="grey lighten-5">
               <template v-slot:[`item.actions`]="{ item }">
                    <v-icon small class="mr-2" @click="editHandler(item)" color="blue"  v-if="haveAccess()==1">
                        mdi-pencil
                    </v-icon>
                    <v-icon small @click="deleteHandler(item.id_bahan)" color="red"  v-if="haveAccess()==1">
                        mdi-delete
                    </v-icon>
                </template>
            </v-data-table>
        </v-card>

 <v-dialog v-model="dialogConfirm" persistent max-width="400px">
      <v-card>
        <v-card-title>
          <span class="headline">warning!</span>
        </v-card-title>
        <v-card-text>
          Anda yakin ingin menghapus Bahan ini?
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

<v-dialog v-model="dialog" persistent max-width="600px">
    <v-card>
        <v-card-title>
            <span class="headline">{{ formTitle }} </span>
        </v-card-title>
        <v-card-text>
            <v-container>
                <v-text-field
                    v-model="form.nama_bahan"
                    label="Nama Bahan"
                    :rules="[v => !!v || 'Nama Bahan tidak boleh kosong']"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="form.jumlah_stok"
                    label="Jumlah Stok"
                    :rules="[v => !!v || 'Jumlah Stok harus terisi']"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="form.harga_bahan"
                    label="Harga"
                    :rules="[v => !!v || 'Harga bahan harus terisi']"
                    required
                ></v-text-field>

                 
               
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
            headers: [
                { text: "Id",
                align: "start",
                sortable: true,
                value: "id_bahan" },
                { text: "Nama Bahan", value: "nama_bahan" }, 
                { text: "Stok", value: "jumlah_stok" },
                { text: "Harga Bahan", value: "harga_bahan" },
                { text: "Actions", value: "actions" },
            ],
            Bahan: new FormData,
            Bahans: [],
            form: {
                nama_bahan: null,
                jumlah_stok: null,
                harga_bahan: null,
                
            },
            deleteId: '',
            editId: '',
        };
    },
    methods: {
        haveAccess() {
        if(localStorage.getItem("current_role") === '2')
          return 1
        else
          return 0
        },
        setForm() {
            if (this.inputType === 'Tambah') {
                this.save()
            } else {
                this.update()
            }
        },
        //read data Bahan
        readDataBahan() {
            var url = this.$api + '/bahan'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.Bahans = response.data.data
            })
        },



        //simpan data produk
        save() {

            this.Bahan.append('nama_bahan', this.form.nama_bahan);
            this.Bahan.append('jumlah_stok', this.form.jumlah_stok);
            this.Bahan.append('harga_bahan', this.form.harga_bahan);
            

            var url = this.$api + '/bahan/'
            this.load = true
            this.$http.post(url, this.Bahan, {
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load = false;
                this.close();
                this.readDataBahan(); //mengambil data
                this.resetForm(); 
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            })
        },
        //ubah data produk
        update() {
            let newData = {
                nama_bahan: this.form.nama_bahan,
                jumlah_stok:this.form.jumlah_stok,
                harga_bahan:this.form.harga_bahan,
        
            }
            var url = this.$api + '/bahan/' + this.editId;
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
                this.readDataBahan(); //mengambil data
                this.resetForm();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            }) 
        },
        //hapus data Bahan
        deleteData() {
            //mengahapus data 
            var url = this.$api + '/bahan/' + this.deleteId;
            //data dihapus berdasarkan id 
            this.$http.delete(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('current_token')
            }
            }).then(response => {
            this.error_message = response.data.message;
            this.color = "green"
            this.snackbar = true;
            this.load = false;
            this.close();
            this.readDataBahan(); //mengambil data
            this.resetForm();
            this.inputType = 'Tambah';
            this.dialogConfirm = false;
            }).catch(error => {
            this.error_message = error.response.data.message;
            this.color = "red"
            this.snackbar = true;
            this.load = false;
            })
        },
        editHandler(item){
            this.inputType = 'Ubah';
            this.editId = item.id_bahan;
            this.form.nama_bahan = item.nama_bahan;
            this.form.jumlah_stok= item.jumlah_stok;
            this.form.harga_bahan = item.harga_bahan;
            this.dialog = true;
        },
        deleteHandler(id){
            this.deleteId = id;
            this.dialogConfirm = true;
        },
        close() {
            this.dialog = false
            this.dialogConfirm = false
            
            this.inputType = 'Tambah';
        },
        cancel() {
            this.resetForm();
            this.readDataBahan();
            this.dialog = false;
            this.inputType = 'Tambah';
        },
        resetForm() {
            this.form = {
                nama_bahan: null,
                jumlah_stok: null,
                harga_bahan: null,
    
            };
        },
    },
    computed: {
        formTitle() {
            return this.inputType 
        },
    },
    mounted() {
        this.readDataBahan()
    },
};
</script>
<style>
/* Helper classes */
.basil {
  background-color: #FFFBE6 !important;
}
.basil--text {
  color: #356859 !important;
}

.primary--text{
        font-size: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .status{
        font-size: 15px;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>