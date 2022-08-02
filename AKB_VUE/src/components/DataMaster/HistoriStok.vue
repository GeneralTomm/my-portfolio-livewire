<template>
    <v-main class="list">
        <v-card class="grey lighten-5">
            <v-card-title class="text-center justify-center py-6">
                <h3 class="text-h3 font-weight-medium mb-5">Historikal Stok</h3>
            </v-card-title>

            <v-tabs
                v-model="tab"
                background-color="transparent"
                color="basil"
                grow
                >
                <v-tab
                v-for="item in items"
                :key="item"
                >
                    {{ item }}
                </v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab">
                <v-tab-item
                :key="item">
                    <v-card class="grey lighten-5">
                        <v-card-title>
                            <v-toolbar-title>TABEL HISTORI STOK MASUK</v-toolbar-title>
                            <v-divider
                                class="mx-5"
                                inset
                                vertical
                            ></v-divider>
                            <v-text-field
                                v-model="search"
                                append-icon="ui-magnify"
                                label="Search"
                                single-line
                                hide-details>
                            </v-text-field>
                            <v-spacer></v-spacer>
                            <v-btn color="success" dark @click="dialog = true">
                                Tambah
                            </v-btn>
                        </v-card-title>
                        <v-data-table 
                            :headers="headerIncomming" 
                            :items="historiStok" 
                            :search="search"
                            class="grey lighten-5"
                            loading-text="Harap tunggu sebentar"
                        >
                        <template v-slot:[`item.actions`]="{ item }">
                            <v-icon left  @click="editHandlerStokMasuk(item)" color="blue">
                                mdi-pencil-plus-outline
                            </v-icon>
                            <v-icon left  @click="deleteHandler(item.id_histori_stok)" color="red">
                                mdi-trash-can-outline
                            </v-icon>
                        </template>
    
                        </v-data-table>
                    </v-card>
                    <v-dialog v-model="dialog" persistent max-width="700px">
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{formTitle}}</span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>

                                    <v-select
                                        :items="stoks"
                                        item-text="nama_bahan"
                                        item-value="id_stok"
                                        label="Nama Bahan"
                                        prepend-icon="mdi-food-variant"
                                        dense
                                        v-model="formStokMasuk.id_stok"
                                        required>
                                    </v-select>

                                    <v-text-field
                                        v-model="formStokMasuk.tgl_masuk_stok"
                                        label="Tanggal Stok Bahan Masuk"
                                        prepend-icon="mdi-calendar"
                                        required
                                        type="date">
                                    </v-text-field>

                                    <v-text-field
                                        v-model="formStokMasuk.incomming_stok"
                                        label="Jumlah Stok Bahan Masuk (gr/ml)"
                                        prepend-icon="mdi-basket-plus"
                                        required
                                        type="number">
                                    </v-text-field>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="cancelStokMasuk">
                                    Cancel
                                </v-btn >
                                <v-btn  color="blue darken-1" text @click="setFormStokMasuk">
                                    Save
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>

                    <v-dialog v-model="dialogConfirm" persistent max-width="300px">
                        <v-card>
                            <v-card-title>
                                <span class="headline">PERINGATAN!</span>
                            </v-card-title>
                            <v-card-text>
                                Anda yakin ingin menghapus data bahan ini?
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="dialogConfirmStokMasuk = false">
                                    Cancel
                                </v-btn>
                                <v-btn color="blue darken-1" text @click="deleteDataStokMasuk"> 
                                    Delete
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-snackbar v-model="snackbar" :color="color" timeout="2000" bottom> 
                        {{error_message}} 
                    </v-snackbar>
                </v-tab-item>

                <v-tab-item
                    :key="item">
                    <v-card class="grey lighten-5">
                        <v-card-title>
                            <v-toolbar-title>TABEL HISTORI STOK TERPAKAI</v-toolbar-title>
                            <v-divider
                                class="mx-5"
                                inset
                                vertical
                            ></v-divider>
                            <v-text-field
                                v-model="search"
                                append-icon="ui-magnify"
                                label="Search"
                                single-line
                                hide-details>
                            </v-text-field>
                            <v-spacer></v-spacer>
                            <v-btn color="blue" dark @click="dialogStokKeluar = true">
                                Tambah
                            </v-btn>
                        </v-card-title>
                        <v-data-table 
                            :headers="headerUsed" 
                            :items="historiStok" 
                            :search="search"
                            class="grey lighten-5"
                            loading-text="Harap tunggu sebentar"
                        >
                        <template v-slot:[`item.actions`]="{ item }">
                            <v-icon left  @click="editHandlerStokKeluar(item)" color="blue">
                                mdi-pencil-plus-outline
                            </v-icon>
                            <v-icon left  @click="deleteHandlerStokKeluar(item.id_Histori_bahan)" color="red">
                                mdi-trash-can-outline
                            </v-icon>
                        </template>
    
                        </v-data-table>
                    </v-card>

                    <v-dialog v-model="dialogStokKeluar" persistent max-width="700px">
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{formTitle}}</span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>

                                    <v-select
                                        :items="stoks"
                                        item-text="nama_bahan"
                                        item-value="id_stok"
                                        label="Nama Bahan"
                                        prepend-icon="mdi-food-variant"
                                        dense
                                        v-model="formStokKeluar.id_stok"
                                        required>
                                    </v-select>

                                    <v-text-field
                                        v-model="formStokKeluar.tgl_keluar_stok"
                                        label="Tanggal Stok Bahan Terpakai"
                                        prepend-icon="mdi-calendar"
                                        required
                                        type="date">
                                    </v-text-field>

                                    <v-text-field
                                        v-model="formStokKeluar.remaining_stok"
                                        label="Jumlah Stok Bahan Keluar (gr/ml)"
                                        prepend-icon="mdi-basket-plus"
                                        required
                                        type="number">
                                    </v-text-field>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="cancelStokKeluar">
                                    Cancel
                                </v-btn >
                                <v-btn  color="blue darken-1" text @click="setFormStokKeluar">
                                    Save
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>

                    <v-dialog v-model="dialogConfirmStokKeluar" persistent max-width="300px">
                        <v-card>
                            <v-card-title>
                                <span class="headline">PERINGATAN!</span>
                            </v-card-title>
                            <v-card-text>
                                Anda yakin ingin menghapus data bahan ini?
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="dialogConfirm = false">
                                    Cancel
                                </v-btn>
                                <v-btn color="blue darken-1" text @click="deleteDataStokKeluar"> 
                                    Delete
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-snackbar v-model="snackbar" :color="color" timeout="2000" bottom> 
                        {{error_message}} 
                    </v-snackbar>
                </v-tab-item>

                <v-tab-item
                    :key="item">
                        <v-card class="grey lighten-5">
                            <v-card-title>
                                <v-toolbar-title>TABEL Histori STOK TERBUANG</v-toolbar-title>
                                <v-divider
                                    class="mx-5"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-text-field
                                    v-model="search"
                                    append-icon="ui-magnify"
                                    label="Search"
                                    single-line
                                    hide-details>
                                </v-text-field>
                                <v-spacer></v-spacer>
                                <v-btn color="orange" dark @click="dialogStokTerbuang = true">
                                    Tambah
                                </v-btn>
                            </v-card-title>
                            <v-data-table 
                            :headers="headerWasteStok" 
                            :items="historiStok" 
                            :search="search"
                            class="grey lighten-5"
                            loading-text="Harap tunggu sebentar"
                            >
                            <template v-slot:[`item.actions`]="{ item }">
                                <v-icon left  @click="editHandlerStokTerbuang(item)" color="blue">
                                mdi-pencil-plus-outline
                                </v-icon>
                                <v-icon left  @click="deleteHandlerStokTerbuang(item.id_histori_stok)" color="red">
                                mdi-trash-can-outline
                                </v-icon>
                            </template>
    
                        </v-data-table>
                    </v-card>

                    <v-dialog v-model="dialogStokTerbuang" persistent max-width="700px">
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{formTitle}}</span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>

                                    <v-select
                                        :items="stoks"
                                        item-text="nama_bahan"
                                        item-value="id_stok"
                                        label="Nama Bahan"
                                        prepend-icon="mdi-food-variant"
                                        dense
                                        v-model="formStokTerbuang.id_stok"
                                        required>
                                    </v-select>

                                    <v-text-field
                                        v-model="formStokTerbuang.tgl_waste_stok"
                                        label="Tanggal Stok Bahan Terbuang"
                                        prepend-icon="mdi-calendar"
                                        required
                                        type="date">
                                    </v-text-field>

                                    <v-text-field
                                        v-model="formStokTerbuang.waste_stok"
                                        label="Jumlah Stok Bahan Terbuang (gr/ml)"
                                        prepend-icon="mdi-basket-plus"
                                        required
                                        type="number">
                                    </v-text-field>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="cancelStokTerbuang">
                                    Cancel
                                </v-btn >
                                <v-btn  color="blue darken-1" text @click="setFormStokTerbuang">
                                    Save
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>

                    <v-dialog v-model="dialogConfirmStokTerbuang" persistent max-width="300px">
                        <v-card>
                            <v-card-title>
                                <span class="headline">PERINGATAN!</span>
                            </v-card-title>
                            <v-card-text>
                                Anda yakin ingin menghapus data bahan ini?
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="dialogConfirmStokKeluar = false">
                                    Cancel
                                </v-btn>
                                <v-btn color="blue darken-1" text @click="deleteDataStokTerbuang"> 
                                    Delete
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-snackbar v-model="snackbar" :color="color" timeout="2000" bottom> 
                        {{error_message}} 
                    </v-snackbar>
                </v-tab-item>

                <v-tab-item
                    :key="item">
                        <v-card class="grey lighten-5">
                            <v-card-title>
                                <v-toolbar-title>TABEL DATA STOK BAHAN HABIS</v-toolbar-title>
                                <v-divider
                                    class="mx-5"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-text-field
                                    v-model="search"
                                    append-icon="ui-magnify"
                                    label="Search"
                                    single-line
                                    hide-details>
                                </v-text-field>
                                <v-spacer></v-spacer>
                            </v-card-title>
                            <v-data-table 
                            :headers="headerBahanHabis" 
                            :items="bahansHabis" 
                            :search="search"
                            class="grey lighten-5"
                            loading-text="Harap tunggu sebentar"
                            >
                            <template v-slot:[`item.jumlah_stok_bahan`]="{item}">
                            <td>
                                <v-chip v-if="item.jumlah_stok_bahan <= 0" color="red">
                                    {{ item.jumlah_stok_bahan }}
                                </v-chip>
                                <v-chip v-else color="success">
                                    {{ item.jumlah_stok_bahan }}
                                </v-chip>
                            </td>
                        </template>
                        </v-data-table>
                    </v-card>
                </v-tab-item>
            </v-tabs-items>
        </v-card>
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
            dialogStokKeluar: false,
            dialogStokTerbuang:false,
            dialogConfirmStokMasuk:false,
            dialogConfirmStokKeluar:false,
            dialogConfirmStokTerbuang:false,
            tab: null,
            items: [
            'Data Stok Masuk', 'Data Stok Terpakai','Data Stok Terbuang'
            ],
            headerIncomming: [
                {
                    text: "Nama Bahan",
                     align: "start",
                     sortable: true,
                    value: "nama_bahan",
                },
                { text: "Tanggal Stok Masuk", value: "tgl_masuk_stok"},
                { text: "Jumlah Stok Masuk (gr/ml)", value: "incomming_stok" },
                { text: "Actions", value: "actions" },
            ],
            headerUsed:[
                {
                    text: "Nama Bahan",
                    align: "start",
                    sortable: true,
                    value: "nama_bahan"
                },
                { text: "Tanggal Stok Keluar Masak", value:"tgl_keluar_stok"},
                { text: "Jumlah Stok Keluar Masak (gr/ml)", value:"remaining_stok"},
                { text: "Actions", value: "actions"},
            ],
            headerWasteStok:[
                {
                    text: "Nama Bahan",
                    align: "start",
                    sortable: true,
                    value: "nama_bahan"
                },
                { text: "Tanggal Stok Terbuang", value:"tgl_waste_stok"},
                { text: "Jumlah Stok Terbuang (gr/ml)", value:"waste_stok"},
                { text: "Actions", value: "actions"},
            ],
            
            historikal_bahan: new FormData,
            historikal_bahan_keluar: new FormData,
            historikal_bahan_terbuang: new FormData,
            historiStok: [],
            formStokMasuk: {
                id_stok: null,
                tgl_masuk_stok: null,
                incomming_stok:null,
                // jumlah_bahan_tersedia:null,
            },
            formStokKeluar: {
                id_stok: null,
                tgl_keluar_stok: null,
                remaining_stok:null,
                // jumlah_bahan_tersedia:null,
            },

            formStokTerbuang: {
                id_stok: null,
                tgl_waste_stok: null,
                waste_stok:null,
                // jumlah_bahan_tersedia:null,
            },
            deleteId: '',
            editId: '',
        };
    },
    methods: {
        setFormStokMasuk() {
            if (this.inputType == 'Tambah') {
                this.saveStokMasuk()
            } 
            else {
                this.updateStokMasuk()
            }
        },

        setFormStokKeluar() {
            if (this.inputType == 'Tambah') {
                this.saveStokKeluar()
            } 
            else {
                this.updateStokKeluar()
            }
        },

        setFormStokTerbuang() {
            if (this.inputType == 'Tambah') {
                this.saveStokTerbuang()
            } 
            else {
                this.updateStokTerbuang()
            }
        },
        
        readDataHistorikal() {
            var url = this.$api + '/historikal'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer' + localStorage.getItem('token')
                }
            }).then(response => {
                this.historiStok = response.data.data
            })
        },



        getBahan() {
            var url = this.$api + '/bahan'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer' + localStorage.getItem('token')
                }
            }).then(response => {
                this.stoks = response.data.data;
                // this.bahans = response.data.data[0].id_bahan;
                console.log(this.stoks);
            })
        },

        saveStokMasuk() {
            this.historikal_incomming_stok.append('id_stok', this.formStokMasuk.id_stok);
            this.historikal_incomming_stok.append('tgl_masuk_stok', this.formStokMasuk.tgl_masuk_stok);
            this.historikal_incomming_stok.append('incomming_stok', this.formStokMasuk.incomming_stok);
            var url = this.$api + '/stokDataMasuk'
            this.load = true
            this.$http.post(url, this.historikal_incomming_stok, {
                headers: {
                    'Authorization': 'Bearer' +localStorage.getItem('token')
                }
            }).then(response => {
                if(response.data.historikal_incomming_stok.incomming_stok > response.data.stok.jumlah_stok_bahan) {
                    alert("Maaf Pengurangan Stok Melebihi Batas")
                }
                else {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load= false;
                this.closeStokMasuk();
                this.readDataStokMasuk();
                this.resetFormStokMasuk();
                }
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load= false;
            })
        },

        saveStokKeluar() {
            this.historikal_bahan_keluar.append('id_stok', this.formStokKeluar.id_stok);
            this.historikal_bahan_keluar.append('tgl_keluar_stok', this.formStokKeluar.tgl_keluar_stok);
            this.historikal_bahan_keluar.append('remaining_stok', this.formStokKeluar.remaining_stok);
            var url = this.$api + '/stokDataKeluar'
            this.load = true
            this.$http.post(url, this.historikal_bahan_keluar, {
                headers: {
                    'Authorization': 'Bearer' +localStorage.getItem('token')
                }
            }).then(response => {
                if(response.data.historikal_bahan.remaining_stok > response.data.stok.jumlah_stok_bahan) {
                    alert("Maaf Pengurangan Stok Melebihi Batas")
                }else{
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load= false;
                this.closeStokKeluar();
                this.readDataStokKeluar();
                this.resetFormStokKeluar();
                }
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load= false;
            })
        },

        saveStokTerbuang() {
            this.historikal_bahan_terbuang.append('id_stok', this.formStokTerbuang.id_stok);
            this.historikal_bahan_terbuang.append('tgl_waste_stok', this.formStokTerbuang.tgl_waste_stok);
            this.historikal_bahan_terbuang.append('waste_stok', this.formStokTerbuang.waste_stok);
            var url = this.$api + '/stokDataTerbuang'
            this.load = true
            this.$http.post(url, this.historikal_bahan_terbuang, {
                headers: {
                    'Authorization': 'Bearer' +localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load= false;
                this.closeStokTerbuang();
                this.readDataStokTerbuang();
                this.resetFormStokTerbuang();
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load= false;
            })
        },

        updateStokMasuk() {
            let newData = {
                'id_stok': this.formStokMasuk.id_stok,
                'tgl_masuk_stok':this.formStokMasuk.tgl_masuk_stok,
                'incomming_stok':this.formStokMasuk.incomming_stok,
            }
            var url = this.$api + '/stokMasuk/' + this.editId;
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
                this.closeStokMasuk();
                this.readDataStokMasuk(); //mengambil data
                this.resetFormStokMasuk();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            })
        },

        updateStokKeluar() {
            let newData = {
                'id_stok': this.formStokKeluar.id_stok,
                'tgl_keluar_stok':this.formStokKeluar.tgl_keluar_stok,
                'remaining_stok':this.formStokKeluar.remaining_stok,
            }
            var url = this.$api + '/stokKeluar/' + this.editId;
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
                this.closeStokKeluar();
                this.readDataStokKeluar(); //mengambil data
                this.resetFormStokKeluar();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            })
        },

        updateStokTerbuang() {
            let newData = {
                'id_stok': this.formStokTerbuang.id_stok,
                'tgl_waste_stok':this.formStokTerbuang.tgl_waste_stok,
                'waste_stok':this.formStokTerbuang.waste_stok,
            }
            var url = this.$api + '/stokTerbuang/' + this.editId;
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
                this.closeStokTerbuang();
                this.readDataStokTerbuang(); //mengambil data
                this.resetFormStokTerbuang();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            })
        },

        editHandlerStokMasuk(item){
            this.inputType = 'Ubah';
            this.editId = item.id_historikal_bahan;
            this.formStokMasuk.id_stok = item.id_stok;
            this.formStokMasuk.tgl_masuk_stok = item.tgl_masuk_stok;
            this.formStokMasuk.incomming_stok = item.incomming_stok;
            this.dialog=true;
        },

        editHandlerStokKeluar(item){
            this.inputType = 'Ubah';
            this.editId = item.id_historikal_bahan;
            this.formStokKeluar.id_stok = item.id_stok;
            this.formStokKeluar.tgl_keluar_stok = item.tgl_keluar_stok;
            this.formStokKeluar.remaining_stok = item.remaining_stok;
            this.dialogStokKeluar=true;
        },

        editHandlerStokTerbuang(item){
            this.inputType = 'Ubah';
            this.editId = item.id_historikal_bahan;
            this.formStokTerbuang.id_stok = item.id_stok;
            this.formStokTerbuang.tgl_waste_stok = item.tgl_waste_stok;
            this.formStokTerbuang.waste_stok = item.waste_stok;
            this.dialogStokTerbuang=true;
        },

        deleteDataStokMasuk() {
            //mengahapus data
            var url = this.$api + '/stokMasukHapus/' + this.deleteId;
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
                this.closeStokMasuk();
                this.readDataStokMasuk(); //mengambil data
                this.resetFormStokMasuk();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            })
            this.dialogConfirmStokMasuk = false
        },

        deleteDataStokKeluar() {
            //mengahapus data
            var url = this.$api + '/stokKeluarHapus/' + this.deleteId;
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
                this.closeStokKeluar();
                this.readDataStokKeluar(); //mengambil data
                this.resetFormStokKeluar();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            })
            this.dialogConfirmStokKeluar = false
        },

        deleteDataStokTerbuang() {
            //mengahapus data
            var url = this.$api + '/stokTerbuangHapus/' + this.deleteId;
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
                this.closeStokTerbuang();
                this.readDataStokTerbuang(); //mengambil data
                this.resetFormStokTerbuang();
                this.inputType = 'Tambah';
            }).catch(error => {
                this.error_message=error.response.data.message;
                this.color="red"
                this.snackbar=true;
                this.load = false;
            })
            this.dialogConfirmStokTerbuang = false
        },

        deleteHandler(id_historikal_bahan){
            this.deleteId = id_historikal_bahan;
            this.dialogConfirmStokMasuk = true;
        },

        deleteHandlerStokKeluar(id_historikal_bahan){
            this.deleteId = id_historikal_bahan;
            this.dialogConfirmStokKeluar = true;
        },

        deleteHandlerStokTerbuang(id_historikal_bahan){
            this.deleteId = id_historikal_bahan;
            this.dialogConfirmStokTerbuang = true;
        },

        cancelStokMasuk() {
            this.resetFormStokMasuk();
            this.readDataHistorikal();
            this.dialog = false;
            this.dialogEdit = false;
            this.inputType = 'Tambah';
        },

        cancelStokKeluar() {
            this.resetFormStokKeluar();
            this.readDataHistorikal();
            this.dialogStokKeluar = false;
            this.dialogEdit = false;
            this.inputType = 'Tambah';
        },

        cancelStokTerbuang() {
            this.resetFormStokTerbuang();
            this.readDataHistorikal();
            this.dialogStokTerbuang = false;
            this.dialogEdit = false;
            this.inputType = 'Tambah';
        },

        closeStokMasuk() {
            this.resetFormStokMasuk();
            this.readDataStokMasuk();
            this.dialog = false;
            this.inputType = 'Tambah';
        },

        closeStokKeluar() {
            this.resetFormStokKeluar();
            this.readDataStokKeluar();
            this.dialogStokKeluar = false;
            this.inputType = 'Tambah';
        },

        closeStokTerbuang() {
            this.resetFormStokTerbuang();
            this.readDataStokTerbuang();
            this.dialogStokTerbuang = false;
            this.inputType = 'Tambah';
        },

        resetFormStokMasuk() {
            this.formStokMasuk = {
                id_stok: null,
                tgl_masuk_stok: null,
                incomming_stok: null,
            };
        },

        resetFormStokKeluar() {
            this.formStokKeluar = {
                id_stok: null,
                tgl_keluar_stok: null,
                remaining_stok: null,
            };
        },

        resetFormStokTerbuang() {
            this.formStokTerbuang = {
                id_stok: null,
                tgl_waste_stok: null,
                waste_stok: null,
            };
        },

    },
    computed: {
        formTitle() {
            return this.inputType
        },
    },
    mounted() {
        this.readDataHistorikal();
        this.getBahan();
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