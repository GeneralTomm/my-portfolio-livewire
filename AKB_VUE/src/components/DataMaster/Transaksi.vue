<!-- @format -->
  
<template>
<v-main class="list">
<h3 class="text-h3 font-weight-medium mb-5"> Transaksi </h3>

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
    <v-btn color="success" dark @click="dialog = true">
        Tambah Transaksi
    </v-btn>
        </v-card-title>
            <v-data-table :headers="headers" :items="Transaksis" :search="search" item-key="id_transaksi"  class="grey lighten-5">
               <template v-slot:[`item.actions`]="{ item }">
                        <v-icon left color="green" @click="showStrukHandler(item)">
                            mdi-arrow-down-bold-circle
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
                        <v-text-field
                            v-model="nomor_meja"
                            :items="nomorMejaItems"
                            prepend-icon="mdi-desk"
                            label="Masukkan Nomor Meja"
                            v-on:change="readPesananNoMeja(nomor_meja),readPesananHarga(nomor_meja)"
                            required
                           :rules="[v => !!v || 'Nomor Meja tidak boleh kosong']">
                        </v-text-field>

                        <v-data-table
                            v-if="nomor_meja != null" 
                            :headers="headerPesananNoMeja" 
                            :items="detailPesananNoMeja" 
                            loading-text="Harap tunggu sebentar"
                            sort-by="status_pesanan"
                        >
                        </v-data-table>

                        <v-data-table
                            v-if="nomor_meja != null" 
                            :headers="headerPesananHarga" 
                            :items="detailHargaPesanan" 
                            loading-text="Harap tunggu sebentar"
                            sort-by="status_pesanan"
                        >
                        </v-data-table>

                        <!-- <v-text-field
                            v-model="formTransaksi.id_karyawan"
                            label="Id Karyawan"
                           :rules="[v => !!v || 'Nomor Meja tidak boleh kosong']">
                        </v-text-field> -->

                        <v-select
                            :items="pemesanans"
                            item-text="id_pesanan"
                            item-value="id_pesanan"
                            label="ID Pesanan"
                            prepend-icon="mdi-food"
                            dense
                            v-model="formTransaksi.id_pesanan"
                            required
                            :rules="[v => !!v || 'Id Pesanan tidak boleh kosong']"
                            >
                        </v-select>

                        <v-select
                            v-model="formTransaksi.jenis_pembayaran"
                            label="Jenis Pembayaran"
                            prepend-icon="mdi-wallet-plus-outline"
                            :items="['Cash', 'Debit', 'Credit']"
                            required
                            :rules="[v => !!v || 'Jenis Pembayaran tidak boleh kosong']"
                            >
                        </v-select>

                        <v-text-field
                            v-if="formTransaksi.jenis_pembayaran == 'Debit' ||
                                formTransaksi.jenis_pembayaran =='Credit'"
                                v-model="formTransaksi.nama_pemilik"
                                prepend-icon="mdi-card-account-details-outline"
                                label="Nama Pemilik Kartu"
                               :rules="[v => !!v || 'Nama Pemilik tidak boleh kosong']">
                        </v-text-field>

                         <v-text-field
                            v-if="formTransaksi.jenis_pembayaran == 'Debit' ||
                                formTransaksi.jenis_pembayaran =='Credit'"
                                v-model="formTransaksi.no_kartu"
                                prepend-icon="mdi-credit-card-outline"
                                label="Nomor Kartu Pembayaran"
                                :rules="[v => !!v || 'Nomor Kartu tidak boleh kosong']">
                        </v-text-field>

                        <v-text-field
                            v-model="formTransaksi.jumlah_bayar"
                            prepend-icon="mdi-cash-multiple"
                            label="Jumlah Pembayaran"
                            type="number"
                            required
                            :rules="[v => !!v || 'Jumlah Pembayaran tidak boleh kosong']" >
                        </v-text-field>
                        
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="cancel">
                        Cancel
                    </v-btn >
                    <v-btn  color="blue darken-1" text @click="setForm">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="dialogStruk" max-width="650px">
            <v-card>
                <div id="printableArea">
                    <v-card-text>
                        <!-- <div style="float: right; width: 400px">
                            <h1 style="text-align: center; font-weight: bold">
                                ATMA KOREAN BBQ
                            </h1>
                            <h6 style="text-align: center; color: red;">FUN PLACE TO GRILL!</h6>
                            <h6 style="text-align: center">Jl. Babarsari No. 43 Yogyakarta</h6>
                            <h6 style="text-align: center">552181</h6>
                            <h6 style="text-align: center">Telp. (0274) 487711</h6>
                        </div> -->
                        <v-img
                            :src="require('@/assets/LogoStruk.png')"
                             max-width="500"
                            style="align: middle;"
                        />
                        <h5 class="fontBottom mt-1 mb-1">
                            -----------------------------------------------------------------------------------------
                        </h5>
                        <p class="mt-0 font1 teksPosition">
                            Receipt # {{ struk.no_transaksi }} <br>Waiter {{ struk.nama_karyawan }}
                        </p>
                        <p class="mt-0 font1 teksPositionKanan1">
                            Date {{ struk.tgl_transaksi }} <br>Time {{ struk.waktu_transaksi }}
                        </p>
                        <br><br><br>
                        <p class="fontBottom">
                            -----------------------------------------------------------------------------------------
                        </p>
                        <p class="mt-0 font1 teksPosition">Table # {{ struk.no_meja }}</p>
                        <p class="mt-0 font1 teksPositionKanan1">
                            Customer {{ struk.nama_customer }}
                        </p>
                        <br><br>
                        <p class="fontBottom mt-1 mb-1">
                            -----------------------------------------------------------------------------------------
                        </p>
                        <v-data-table
                            :hide-default-footer="true"
                            :headers="headersDetailPesanan"
                            :items="detailPesanan"
                        >
                            <template v-slot:[`item.subtotal_harga`]="{ item }">
                                Rp {{ item.subtotal_harga }}
                            </template>
                            <template v-slot:[`item.total_harga`]="{ item }">
                                Rp {{ item.total_harga }}
                            </template>
                        </v-data-table>
                        <p class="fontBottom mt-1 mb-1">
                            -----------------------------------------------------------------------------------------
                        </p>
                        <p class="mb-0 font2 teksHarga">
                            Sub Total Rp {{ struk.sub_total }}
                        </p>
                        <p class="mb-1 font2 teksHarga">
                            Service 5% Rp {{ struk.service }}
                        </p>
                        <p class="mb-1 font2 teksHarga">Tax 10% Rp {{ struk.tax }}</p>
                        <p class="fontBottom mt-1 mb-1">
                            -----------------------------------------------------------------------------------------
                        </p>
                        <p class="mb-0 font2 teksHarga">
                            Total Rp {{ struk.total_harga }}
                        </p>
                        <p class="fontBottom mt-1 mb-1">
                            -----------------------------------------------------------------------------------------
                        </p>
                        <p class="mb-1 font3 teksHarga">Total Qty: {{ struk.total_qty }}</p>
                        <p class="mb-1 font3 teksHarga">
                            Total Item: {{ struk.total_item }}
                        </p>
                        <p class="mt-1 font3 teksHarga">Printed {{ dateTime }}</p>
                        <p class="fontBottom mt-1 mb-1"></p>
                        <p class="mt-1 font3 teksHarga">Cashier: {{ printedCashier }}</p>
                        <p class="fontBottom mt-1 mb-1">
                            -----------------------------------------------------------------------------------------
                        </p>
                        <p class="fontBottom mt-0 mb-0">THANK YOU FOR YOUR VISIT</p>
                        <p class="fontBottom mt-1 mb-1">
                            -----------------------------------------------------------------------------------------
                        </p>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="red darken-1" dark @click="dialogStruk = false">
                            Close
                        </v-btn>
                        <v-btn color="green darken-1" dark @click="printStruk('printableArea')">
                            Print
                        </v-btn>
                    </v-card-actions>
                </div>
                
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
            printedCashier:'',
            nomor_meja:null,
            search: null,
            dateTime: '',
            detailHargaPesanan : [],
            dialog: false,
            dialogStruk: false,
            dialogConfirm: false,
            headers: [
                { text: "Id",
                align: "start",
                sortable: true,
                value: "id_transaksi" },
                { text: "Id Pesanan", value: "id_pesanan" },
                { text: "Cashier", value: "nama_karyawan" },
                { text: "Nomor Transaksi", value: "no_transaksi" },
                { text: "Tanggal", value: "tgl_transaksi" },
                { text: "Waktu", value: "waktu_transaksi" },
                { text: "Actions", value: "actions" },
            ],
            headerPesananHarga :[
                {
                    text: "Nomor Meja",
                     align: "start",
                     sortable: true,
                    value: "no_meja",
                },
                { text: "Service", value: "service"},
                { text: "Tax", value: "tax"},
                { text: "Total", value: "total_harga"},
                
            ],
          
            headerInfoTransaksi:[
                {
                    text: "Nomor Meja",
                     align: "start",
                     sortable: true,
                    value: "nomor_meja",
                },
                { text: "Jenis Pembayaran", value: "jenis_pembayaran"},
                { text: "Nama Pemilik Kartu", value: "nama_pemilik" },
                { text: "Nomor Kartu Pembayaran", value: "no_kartu"},
                { text: "Kode Pembayaran", value:"kode_verifikasi"},
            ],
             headerPesananNoMeja:[
                {
                    text: "ID Pesanan",
                     align: "start",
                     sortable: true,
                    value: "id_pesanan",
                },
                { text:"Nama Menu", value:"nama_menu"},
                { text:"Jumlah Item Pesanan", value:"jumlah_item_pesanan"},
                { text:"Sub Total Harga", value:"subtotal_harga"},
            ],
             headersDetailPesanan: [
                {
                    text: "Qty",
                    value: "jumlah_item_pesanan",
                },
                {
                    text: "Item Menu",
                    value: "nama_menu"
                },
                {
                    text: "Harga",
                    value: "subtotal_harga"
                },
               
            ],
            Transaksi: new FormData,
            Transaksis: [],
            nomorMejaItems:[],
            customers:[],
            pemesanans:[],
            pesananMeja:[],
            pesananMejaTransaksi:[],
            detailPesananNoMeja:[],
             detailPesanan:[],
            infoTransaksi:[],
            struk: [],
            formTransaksi: {
                id_meja:null,
                id_karyawan:localStorage.getItem("current_id"),
                id_pesanan:null,
                jenis_pembayaran: null,
                jumlah_bayar: null,
                nama_pemilik:null,
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
        //read data Transaksi
        readDataTransaksi() {
             var url = this.$api + "/transaksi";
            this.$http
                .get(url, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("current_token"),
                    },
                })
                .then((response) => {
                    this.Transaksis = response.data.dataTransaksi;

                    // // OVERRIDE CASHIER COLUMN
                    // for(var i=0; i<this.transaksi.length; i++) {
                    //     this.Transaksis[i].nama_karyawan = response.data.namaCashier[i].nama_karyawan
                    // }

                    // this.loading = false;
                })
                .catch((error) => {
                    this.error_message = error.response.data.message;
                    this.color = "red";
                    this.snackbar = true;
                    this.load = false;
                    this.loading = false;
                });
        },
        getNomorMejaMakan() {
            var url = this.$api + '/getMejaPesanan'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('current_token')
                }
            }).then(response => {
                for(var i = 0; i < response.data.data.length; i++) {
                        this.nomorMejaItems.push(response.data.data[i]);
                }
            }).catch(error => {
                this.error_message = error.response.data.message;
                this.snackbar = true;
                this.load = false;
            })
        },
        readPesananTransaksi() {
            var url = this.$api + '/pesananTransaksi'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer' + localStorage.getItem('token')
                }
            }).then(response => {
                this.pemesanans = response.data.data
                this.readPesananTransaksi()
            })
        },
        //simpan data produk
        save() {
            this.karyawan = localStorage.getItem("current_id");
            this.Transaksi.append('id_karyawan', this.karyawan);
            this.Transaksi.append('id_pesanan', this.formTransaksi.id_pesanan);
            this.Transaksi.append('jenis_pembayaran', this.formTransaksi.jenis_pembayaran);
            this.Transaksi.append('nama_kartu', this.formTransaksi.nama_pemilik);
            this.Transaksi.append('no_kartu_pembayaran', this.formTransaksi.no_kartu);
            this.Transaksi.append('jumlah_bayar', this.formTransaksi.jumlah_bayar);

            var url = this.$api + '/transaksi/'
            this.load = true
            this.$http.post(url, this.Transaksi, {
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load = false;
                this.close();
                this.readDataTransaksi(); //mengambil data
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
        
        readPesananNoMeja(nomor_meja) {
            var url = this.$api + '/pesananByMeja/' + nomor_meja
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.detailPesananNoMeja = response.data.data
                console.log(this.detailPesananNoMeja);
            }).catch(error => {
                this.error_message = error.response.data.message;
                this.snackbar = true;
                this.load = false;
            })
        },

         readPesananHarga(nomor_meja) {
            var url = this.$api + '/pesananHarga/' + nomor_meja
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.detailHargaPesanan = response.data.data
                console.log(this.detailHargaPesanan);
            }).catch(error => {
                this.error_message = error.response.data.message;
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
       close() {
            this.resetForm();
            this.readDataTransaksi();
            this.dialog = false;
            this.dialogDetailTransaksi = false;
            this.dialogStruk = false;
            this.inputType = 'Tambah';
        },

        resetForm() {
            this.detailPesananNoMeja=[null],
            this.nomor_meja = null,
            this.formTransaksi = {
                id_karyawan:null,
                id_pesanan:null,
                jenis_pembayaran: null,
                jumlah_bayar: null,
                nama_kartu:null,
            };
        },

        cancel() {
            this.resetForm();
            this.readDataTransaksi();
            this.dialog = false;
            this.dialogQR = false;
            this.dialogDetailTransaksi = false;
            this.dialogStruk = false;
            this.inputType = 'Tambah';
        },
         readDataDetailPesanan(idPesanan) {
            var url = this.$api + "/detailcari/" + idPesanan;
            this.$http
                .get(url, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("current_token"),
                    },
                })
                .then((response) => {
                    this.detailPesanan = response.data.data;
                    this.dialogDetail = true;
                })
                .catch((error) => {
                    this.dialogDetail = true;
                    this.error_message = error.response.data.message;
                    this.color = "red";
                    this.snackbar = true;
                    this.load = false;
                });
        },
        showStrukHandler(item) {
            this.readDataDetailPesanan(item.id_pesanan)
            this.getStrukInfo(item.id_transaki)
            this.struk.no_transaksi= item.no_transaksi
            this.struk.nama_karyawan= item.nama_karyawan
            this.struk.tgl_transaksi= item.tgl_transaksi
            this.struk.waktu_transaksi= item.waktu_transaksi
            this.struk.no_meja= item.no_meja
            this.struk.nama_customer= item.nama_customer
            this.struk.sub_total= item.sub_total
            this.struk.total_qty= item.total_qty
            this.struk.total_harga= item.total_harga
            this.struk.service= item.service
            this.struk.tax= item.tax
            this.struk.total_harga= item.total_harga
            this.struk.total_item= item.total_item
         
            this.getCurrentDateTime();
            this.printedCashier = localStorage.getItem("nama_karyawan");
            this.dialogStruk = true;
        },
        getStrukInfo(idTransaksi) {
            var url = this.$api + '/strukInfoTransaksi/' + idTransaksi;
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('current_token')
                }
            }).then(response => {
                this.struk = response.data.data
            }).catch(error => {
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
                this.loading = false
            })
        },
        printStruk(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        },
        getCurrentDateTime() {
            var currentdate = new Date(); 
            this.dateTime = currentdate.getDate() + "/"
                            + (currentdate.getMonth()+1)  + "/" 
                            + currentdate.getFullYear() + " @ "
                            + currentdate.getHours() + ":"  
                            + currentdate.getMinutes() + ":" 
                            + currentdate.getSeconds();
        }
    },

    computed: {
        formTitle() {
            return this.inputType 
        },
    },
    mounted() {
        this.readDataTransaksi();
        this.readDataDetailPesanan();
        this.readPesananTransaksi();
        this.readPesananNoMeja();
        this.getNomorMejaMakan();
         this.readPesananHarga();
    },
};
</script>