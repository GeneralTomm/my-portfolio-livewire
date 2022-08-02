<!-- @format -->
  
<template>
<v-main class="list">
<h3 class="text-h3 font-weight-medium mb-5"> Data Karyawan </h3>

<v-card class="grey lighten-5">
    <v-card-title  class="grey lighten-5">
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
            <v-data-table :headers="headers" :items="karyawans" :search="search"  class="grey lighten-5">
                <template v-slot:[`item.status`]="{ item }">
                    <v-chip
                    :color="getStatusColor(item.status)"
                    dark
                    >
                    {{ item.status }}
                    </v-chip>
                </template>
                <template v-slot:[`item.actions`]="{ item }">
                    <v-icon small class="mr-2" @click="editHandler(item)" color="green">
                        mdi-pencil
                    </v-icon>
                    <v-icon small @click="nonAktifActions(item.id_karyawan)" color="red">
                        mdi-account-off
                    </v-icon>
                </template>
            </v-data-table>
                
        </v-card>

<v-dialog v-model="dialog" @keydown.esc="dialog = false" persistent max-width="600px">
    <v-card>
        <v-card-title>
            <span class="headline">{{ formTitle }} </span>
        </v-card-title>
        <v-card-text>
            <v-container>
                <v-select
                    :items="roles"
                    item-text="nama_role"
                    item-value="id_role"
                    label="Jabatan"
                    prepend-icon="mdi-police-badge"
                    dense
                    v-model="form.selected_role"
                    :rules="RoleRules"
                    required>
                </v-select>
                <v-text-field
                    v-model="form.nama_karyawan"
                    :rules="namaRules"
                    label="Nama Karyawan"
                    prepend-icon="mdi-card-account-details"
                    required
                ></v-text-field>

                <v-select
                    v-model="form.jenis_kelamin"
                    prepend-icon="mdi-account-search"
                    label="Jenis Kelamin"
                    :items="['Laki-laki','Perempuan']"
                    :rules="jkRules"
                    required
                ></v-select>

                <v-text-field
                    v-model="form.no_telp_karyawan"
                    prepend-icon="mdi-phone"
                    label="No Telpon"
                    :rules="telpRules"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="form.email_karyawan"
                    label="Email"
                    prepend-icon="mdi-email"
                    :rules="emailRules"
                    required
                ></v-text-field>
                <v-text-field
                    v-model="form.password"
                    label="Password"
                    prepend-icon="mdi-lock"
                   
                ></v-text-field>
                <v-select
                    v-model="form.status"
                    label="Status Aktif"
                    prepend-icon="mdi-alert"
                    :items="['aktif', 'non-aktif']"
                    :rules="statusRules"
                    required
                ></v-select>
                <v-text-field
                    v-model="form.tgl_bergabung"
                    prepend-icon="mdi-calendar"
                    type="date"
                    label="Tanggal Bergabung"
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
            RoleRules: [(v) => !!v || "Jabatan tidak boleh kosong"],
            namaRules: [(v) => !!v || "Nama tidak boleh kosong"],
            jkRules:[(v) => !!v || "Jenis Kelamin tidak boleh kosong"],
            telpRules:[(v) => !!v || "Nomor Telepon tidak boleh kosong"],
            emailRules:[(v) => !!v || "Email tidak boleh kosong"],
            tanggalRules:[(v) => !!v || "Tanggal Bergabung tidak boleh kosong"],
            statusRules:[(v) => !!v || "Status Karyawan tidak boleh kosong"],
            passwordRules:[(v) => !!v || "Password tidak boleh kosong"],
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
                value: "id_karyawan" },
                { text: "Role", value: "nama_role" },
                { text: "Nama Karyawan", value: "nama_karyawan" },
                { text: "Jenis Kelamin", value: "jenis_kelamin" },
                { text: "No Telepon", value: "no_telp_karyawan" },
                { text: "Email Karyawan", value: "email_karyawan" },
                { text: "Status", value: "status" },
                { text: "Tanggal Bergabung", value: "tgl_bergabung" },
                { text: "Actions", value: "actions" },
            ],
            karyawan: new FormData,
            karyawans: [],
            roles: [],
            form: {
                selected_role: "",
                nama_karyawan: null,
                jenis_kelamin: null,
                no_telp_karyawan: null,
                email_karyawan: null,
                password: null,
                status: null,
                tgl_bergabung: null,
            },
            selected_role: "",
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
        //read data karyawan
        readDataKaryawan() {
            var url = this.$api + '/karyawan'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.karyawans = response.data.data
            })
        },
        //read data role
        readDataRole() {
            var url = this.$api + '/role'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.roles = response.data.data
            })
        },
        //simpan data produk
        save() {
            this.karyawan.append('id_role', this.form.selected_role);
            this.karyawan.append('nama_karyawan', this.form.nama_karyawan);
            this.karyawan.append('jenis_kelamin', this.form.jenis_kelamin);
            this.karyawan.append('no_telp_karyawan', this.form.no_telp_karyawan);
            this.karyawan.append('email_karyawan', this.form.email_karyawan);
            this.karyawan.append('password', this.form.password);
            this.karyawan.append('status', this.form.status);
            this.karyawan.append('tgl_bergabung', this.form.tgl_bergabung);

            var url = this.$api + '/karyawan/'
            this.load = true
            this.$http.post(url, this.karyawan, {
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load = false;
                this.close();
                this.readDataKaryawan(); //mengambil data
                this.resetForm(); 
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            })
        },
        //ubah data karyawan
        update() {
            let newData = {
                id_role: this.form.selected_role,
                nama_karyawan: this.form.nama_karyawan,
                jenis_kelamin: this.form.jenis_kelamin,
                no_telp_karyawan:this.form.no_telp_karyawan,
                email_karyawan: this.form.email_karyawan,
                password: this.form.password,
                status: this.form.status,
                tgl_bergabung: this.form.tgl_bergabung,
            }
            var url = this.$api + '/karyawan/' + this.editId;
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
                this.readDataKaryawan(); //mengambil data
                this.resetForm();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            }) 
        },
        //hapus data produk
        deleteData() {
            //mengahapus data
            var url = this.$api + '/karyawan/' + this.deleteId;
            //data dihapus berdasarkan id
            this.$http.delete(url, {
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load = false;
                this.close();
                this.readDataKaryawan(); //mengambil data
                this.resetForm();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            })
            this.dialogConfirm = false
        },
        editHandler(item){
            this.inputType = 'Ubah';
            this.editId = item.id_karyawan;
            this.form.selected_role= item.id_role;
            this.form.nama_karyawan = item.nama_karyawan;
            this.form.jenis_kelamin = item.jenis_kelamin;
            this.form.no_telp_karyawan = item.no_telp_karyawan;
            this.form.email_karyawan = item.email_karyawan;
            this.form.status = item.status;
            this.form.tgl_bergabung=item.tgl_bergabung;
            this.dialog = true;
        },
        deleteHandler(id){
            this.deleteId = id;
            this.dialogConfirm = true;
        },
        close() {
            this.dialog = false
            this.inputType = 'Tambah';
        },
        cancel() {
            this.resetForm();
            this.readDataKaryawan();
            this.dialog = false;
            this.inputType = 'Tambah';
        },
        resetForm() {
            this.form = {
                selected_role: "",
                nama_karyawan: null,
                jenis_kelamin: null,
                no_telp_karyawan: null,
                email_karyawan: null,
                password: null,
                status: null,
                tgl_bergabung: null,
            };
        },
        nonAktifActions(resignId) {
            var url = this.$api + '/resignkaryawan/'+ resignId;
            this.load = true
            this.$http.put(url, null, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('current_token')
            }
            }).then(response => {
            this.error_message = response.data.message;
            this.color = "green"
            this.snackbar = true;
            this.load = false;
            this.readDataKaryawan(); //mengambil data
            }).catch(error => {
            this.error_message = error.response.data.message;
            this.color = "red"
            this.snackbar = true;
            this.load = false;
            })
        },

        haveAccess() {
        if(localStorage.getItem("current_role") === '1' || localStorage.getItem("current_role") === '2')
          return 1
        else
          return 0
        },
        getStatusColor (status) {
        if (status === 'non-aktif') return 'red'
        else if (status === 'aktif') return 'green'
        else return 'orange'
      },
    },
    computed: {
        formTitle() {
            return this.inputType 
        },
    },
    mounted() {
        this.readDataKaryawan();
        this.readDataRole();
    },
};
</script>

<style scoped>

</style>