<!-- @format -->
  
<template>
<v-main class="list">
<h3 class="text-h3 font-weight-medium mb-5"> Customer </h3>

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
            <v-data-table :headers="headers" :items="Customers" :search="search" class="grey lighten-5">
               <template v-slot:[`item.actions`]="{ item }">
                    <v-icon small class="mr-2" @click="editHandler(item)" color="blue">
                        mdi-pencil
                    </v-icon>
                    <v-icon small @click="deleteHandler(item.id_customer)" color="red">
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
            Anda yakin ingin menghapus customer ini?
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
                    v-model="form.nama_customer"
                    label="Nama Customer"
                    :rules="namaRules"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="form.no_hp"
                    label="No Telpon"
                    :rules="telpRules"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="form.email_customer"
                    label="Email"
                    :rules="emailRules"
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
           
            namaRules: [(v) => !!v || "Nama tidak boleh kosong"],
            telpRules:[(v) => !!v || "Nomor Telepon tidak boleh kosong"],
            emailRules:[(v) => !!v || "Email tidak boleh kosong"],
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
                value: "id_customer" },
                { text: "Nama Customer", value: "nama_customer" },
                { text: "No Telepon", value: "no_hp" },
                { text: "Email Customer", value: "email_customer" },
                { text: "Actions", value: "actions" },
            ],
            Customer: new FormData,
            Customers: [],
            roles: [],
            form: {
                nama_customer: null,
                no_hp: null,
                email_customer: null, 
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
        //read data Customer
        readDataCustomer() {
            var url = this.$api + '/customer'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.Customers = response.data.data
            })
        },

        //simpan data produk
        save() {

            this.Customer.append('nama_customer', this.form.nama_customer);
            this.Customer.append('no_hp', this.form.no_hp);
            this.Customer.append('email_customer', this.form.email_customer);

            var url = this.$api + '/customer/'
            this.load = true
            this.$http.post(url, this.Customer, {
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load = false;
                this.close();
                this.readDataCustomer(); //mengambil data
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
                nama_customer: this.form.nama_customer,
                no_hp: this.form.no_hp,
                email_customer: this.form.email_customer,
            }
            var url = this.$api + '/customer/' + this.editId;
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
                this.readDataCustomer(); //mengambil data
                this.resetForm();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            }) 
        },
        //hapus data customer
        deleteData() {
            //mengahapus data 
            var url = this.$api + '/customer/' + this.deleteId;
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
            this.readDataCustomer(); //mengambil data
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
            this.editId = item.id_customer;
            this.form.nama_customer= item.nama_customer;
            this.form.no_hp = item.no_hp;
            this.form.email_customer = item.email_customer;
            this.dialog = true;
        },
        deleteHandler(id){
            this.deleteId = id;
            this.dialogConfirm = true;
        },
        close() {
            this.dialog = false;
            this.dialogConfirm = false;
            this.inputType = 'Tambah';
        },
        cancel() {
            this.resetForm();
            this.readDataCustomer();
            this.dialog = false;
            this.inputType = 'Tambah';
        },
        resetForm() {
            this.form = {
                nama_produk: null,
                satuan: null,
                harga_jual: null,
                stok: null,
            };
        },
    },
    computed: {
        formTitle() {
            return this.inputType 
        },
    },
    mounted() {
        this.readDataCustomer();
    },
};
</script>