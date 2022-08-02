<!-- @format -->
  
<template>
<v-main class="list">
<h3 class="text-h3 font-weight-medium mb-5"> Menu </h3>

<v-card  class="grey lighten-5">
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
            <v-data-table :headers="headers" :items="Menus" :search="search"  class="grey lighten-5">
               <template v-slot:[`item.actions`]="{ item }">
                    <v-icon small class="mr-2" @click="editHandler(item)" color="blue"  v-if="haveAccess()==1">
                        mdi-pencil
                    </v-icon>
                    <v-icon small @click="deleteHandler(item.id_menu)" color="red"  v-if="haveAccess()==1">
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
          Anda yakin ingin menghapus menu ini?
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
                    v-model="form.nama_menu"
                    label="Nama Menu"
                    required
                ></v-text-field>

               <v-select
                    v-model="form.kategori_menu"
                    prepend-icon="mdi-account-search"
                    label="Kategori"
                    :items="['Utama','Side Dish','Minuman']"
                    required
                ></v-select>

                <v-text-field
                    v-model="form.deskripsi_menu"
                    label="Deskripsi"
                    required
                ></v-text-field>

                <v-select
                    v-model="form.unit_menu"
                    label="Unit"
                    :items="['Bowl','Plate','Glass','Bottle']"
                    required
                ></v-select>

                <v-text-field
                    v-model="form.harga_menu"
                    label="Harga"
                    required
                ></v-text-field>

                 <v-select
                    :items="bahans"
                    item-text="nama_bahan"
                    item-value="id_bahan"
                    label="Bahan"
                    prepend-icon="mdi-account-star"
                    dense
                    v-model="form.nama_bahan"
                    required>
                </v-select>
               
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
                value: "id_menu" },
                { text: "Nama Menu", value: "nama_menu" }, 
                { text: "Kategori", value: "kategori_menu" },
                { text: "Deskripsi", value: "deskripsi_menu" },
                { text: "Unit", value: "unit_menu" },
                { text: "Harga", value: "harga_menu" },
                { text: "Bahan", value: "nama_bahan" },
                { text: "Actions", value: "actions" },
            ],
            Menu: new FormData,
            Menus: [],
            bahans: [],
            form: {
                nama_bahan: null,
                nama_menu: null,
                kategori_menu: null,
                deskripsi_menu: null, 
                unit_menu: null,
                harga_menu: null,
                
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
        //read data Menu
        readDataMenu() {
            var url = this.$api + '/menu'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.Menus = response.data.data
            })
        },

        //read data bahan
        readDataBahan() {
            var url = this.$api + '/bahan'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.bahans = response.data.data
            })
        },

        //simpan data produk
        save() {

            this.Menu.append('nama_menu', this.form.nama_menu);
            this.Menu.append('kategori_menu', this.form.kategori_menu);
            this.Menu.append('deskripsi_menu', this.form.deskripsi_menu);
            this.Menu.append('unit_menu', this.form.unit_menu);
            this.Menu.append('harga_menu', this.form.harga_menu);
            this.Menu.append('id_bahan', this.form.nama_bahan);
            

            var url = this.$api + '/menu/'
            this.load = true
            this.$http.post(url, this.Menu, {
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load = false;
                this.close();
                this.readDataMenu(); //mengambil data
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
                nama_menu: this.form.nama_menu,
                kategori_menu: this.form.kategori_menu,
                deskripsi_menu: this.form.deskripsi_menu,
                unit_menu: this.form.unit_menu,
                harga_menu:this.form.harga_menu,
                id_bahan:this.form.nama_bahan,
            }
            var url = this.$api + '/menu/' + this.editId;
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
                this.readDataMenu(); //mengambil data
                this.resetForm();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            }) 
        },
        //hapus data Menu
        deleteData() {
            //mengahapus data 
            var url = this.$api + '/menu/' + this.deleteId;
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
            this.readDataMenu(); //mengambil data
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
            this.editId = item.id_menu;
            this.form.nama_bahan = item.nama_bahan;
            this.form.nama_menu= item.nama_menu;
            this.form.kategori_menu = item.kategori_menu;
            this.form.deskripsi_menu = item.deskripsi_menu;
            this.form.unit_menu = item.unit_menu;
            this.form.harga_menu = item.harga_menu;
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
            this.readDataMenu();
            this.dialog = false;
            this.inputType = 'Tambah';
        },
        resetForm() {
            this.form = {
            nama_bahan: null,
            nama_menu: null,
            kategori_menu: null,
            deskripsi_menu: null, 
            unit_menu: null,
            harga_menu: null,
            };
        },
    },
    computed: {
        formTitle() {
            return this.inputType 
        },
    },
    mounted() {
        this.readDataMenu()
        this.readDataBahan()
    },
};
</script>