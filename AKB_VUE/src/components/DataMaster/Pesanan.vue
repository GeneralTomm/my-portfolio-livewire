<template>
    <v-main class="list">
        <h1 class="text-center" style="font-size:30pt">Data Pesanan</h1>

        <v-tabs
          v-model="tabs"
        >
          <v-tab
            v-for="item in items"
        :key="item"
          >
            {{ item }}
          </v-tab>
        </v-tabs>

      <v-tabs-items v-model="tabs">
      <v-tab-item>
                <v-card>
            <v-card-title>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
            </v-card-title>

            <v-data-table 
                :headers="headers" 
                :items="pesanan" 
                :search="search" 
                :loading="loading" 
                loading-text = "Loading... Please wait"
                
                item-key="id_pesanan"
                >
                <template v-slot:[`item.status_pesanan`]="{ item }">
                    <v-chip
                        :color="getStatusColor(item.status_pesanan)"
                        dark
                    >
                        {{ item.status_pesanan }}
                    </v-chip>
                </template>

                <template v-slot:[`item.actions`]="{ item }">
                    <v-btn small class="mr-2" @click="changeStatusHandler(item)" color="green" >
                        Siap Disajikan
                    </v-btn>
                </template>
                <template v-slot:[`item.actions1`]="{ item }">
                    <v-btn small class="mr-2" @click="detailHandler(item)" color="orange">
                        Menu
                    </v-btn>
                </template>

                <template v-slot:expanded-item="{ headers, item }">
                    <td :colspan="headers.length">
                        <table style="width:20%">
                            <tr>
                                <td>Sub Total</td>
                                <td>: Rp {{ item.subtotal_harga }}</td>
                            </tr>
                            <tr>
                                <td>Service 5%</td>
                                <td>: Rp {{ item.service }}</td>
                            </tr>
                            <tr>
                                <td>Tax 10%</td>
                                <td>: Rp {{ item.tax }}</td>
                            </tr>
                            <tr>
                                <td>Total Qty</td>
                                <td>: {{ item.total_qty }}</td>
                            </tr>
                            <tr>
                                <td>Total Item</td>
                                <td>: {{ item.total_item }}</td>
                            </tr>
                        </table>
                    </td>
                </template>
            </v-data-table>    

        </v-card>
      </v-tab-item>
      
      <v-tab-item>
                <v-card>
            <v-card-title>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
            </v-card-title>

            <v-data-table 
                :headers="headers1" 
                :items="pesananSiap" 
                :search="search" 
                :loading="loading" 
                loading-text = "Loading... Please wait"
                item-key="id_pesanan"
               >
                <template v-slot:[`item.status_pesanan`]="{ item }">
                    <v-chip
                        :color="getStatusColor(item.status_pesanan)"
                        dark
                    >
                        {{ item.status_pesanan }}
                    </v-chip>
                </template>

                <template v-slot:[`item.actions1`]="{ item }">
                    <v-btn small class="mr-2" @click="detailHandler(item)" color="orange">
                        Menu
                    </v-btn>
                </template>

                <template v-slot:expanded-item="{ headers, item }">
                    <td :colspan="headers.length">
                        <table style="width:20%">
                            <tr>
                                <td>Sub Total</td>
                                <td>: Rp {{ item.subtotal_harga }}</td>
                            </tr>
                            <tr>
                                <td>Service 5%</td>
                                <td>: Rp {{ item.service }}</td>
                            </tr>
                            <tr>
                                <td>Tax 10%</td>
                                <td>: Rp {{ item.tax }}</td>
                            </tr>
                            <tr>
                                <td>Total Qty</td>
                                <td>: {{ item.total_qty }}</td>
                            </tr>
                            <tr>
                                <td>Total Item</td>
                                <td>: {{ item.total_item }}</td>
                            </tr>
                        </table>
                    </td>
                </template>
            </v-data-table>    

        </v-card>
      </v-tab-item>
      
</v-tabs-items> 

        <v-dialog v-model="dialogDetail" max-width="1000px">
                <v-card>
                <h1 class="text-center" style="font-size:30pt">Data Detail Pesanan No Meja {{ selectedNoMeja }}</h1>
                <v-data-table :headers="headersDetail" :items="detailPesanan"></v-data-table>
            </v-card>
        </v-dialog>

        <v-dialog v-model="dialogChangeStatus" persistent max-width="550px">
            <v-card>
                <v-card-title>
                    <span class="headline text-center">Anda yakin ingin mengubah status pesanan ini menjadi "Siap Disajikan" ?</span>
                </v-card-title>
                <v-card-actions>
                    <v-col>
                        <v-btn color="green darken-1 pa-2" text @click="dialogChangeStatus = false">
                            <h2>TIDAK</h2>
                        </v-btn>
                    </v-col>
                    <spacer></spacer>
                    <v-col class="text-right">
                        <v-btn color="red darken-1 pa-2" text @click="changeStatus">
                            <h2>YA</h2>
                        </v-btn>
                    </v-col>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-snackbar v-model="snackbar" :color="color" timeout="2000" bottom>
            <v-alert
            outlined
            type="error"
            >{{ error_message }}</v-alert>
        </v-snackbar>
        <v-snackbar v-model="snackbarSuccess" :color="color" timeout="2000" bottom>
            <v-alert
            outlined
            type="success"
            >{{ error_message }}</v-alert>
        </v-snackbar>

    </v-main>
</template>

<script>
export default {
    data() {
        return {
            tabs: null,
            search: '',
            loading: true,
            load: false,
            snackbar: false,
            snackbarSuccess:false,
             color: 'white',
            error_message: '',
            items: [
          'Belum Disajikan', 'Siap Disajikan',
            ],
            headers: [
                {
                    text: "ID Pesanan",
                    value: "id_pesanan"
                },
                {
                    text: "Nama Karyawan",
                    value: "nama_karyawan"
                },
                {
                    text: "No Meja",
                    value: "no_meja"
                },
                {
                    text: "Total QTY",
                    value: "total_qty"
                },
                {
                    text: "Total Item",
                    value: "total_item"
                },
                {
                    text: "Service",
                    value: "service"
                },
                {
                    text: "Tax",
                    value: "tax"
                },
                {
                    text: "Subtotal (Rp)",
                    value: "sub_total"
                },
                {
                    text: "Total (Rp)",
                    value: "total_harga"
                },
                {
                    text: "Ubah Status",
                    value: "actions"
                },
                {
                    text: "Lihat menu",
                    value: "actions1"
                },
            ],
            headers1: [
                {
                    text: "ID Pesanan",
                    value: "id_pesanan"
                },
                {
                    text: "Nama Karyawan",
                    value: "nama_karyawan"
                },
                {
                    text: "No Meja",
                    value: "no_meja"
                },
                {
                    text: "Total QTY",
                    value: "total_qty"
                },
                {
                    text: "Total Item",
                    value: "total_item"
                },
                {
                    text: "Service",
                    value: "service"
                },
                {
                    text: "Tax",
                    value: "tax"
                },
                {
                    text: "Subtotal (Rp)",
                    value: "sub_total"
                },
                {
                    text: "Total (Rp)",
                    value: "total_harga"
                },
                {
                    text: "Lihat menu",
                    value: "actions1"
                },
            ],
            pesanan: [],
            pesananSiap: [],
            editID: '',
            dialogChangeStatus: false,
            dialogDetail: false,
            selectedIDPesanan: '',
            selectedNoMeja:'',
            idPesanan: '',
            detailPesanan: [],
            headersDetail: [
                {
                    text: "Nama Menu",
                    value: "nama_menu"
                },
                {
                    text: "Jumlah Item",
                    value: "jumlah_item_pesanan"
                },
                {
                    text: "Subtotal Item",
                    value: "subtotal_harga"
                },
            ],
        }
    },

    methods: {
        //read data
        readData() {
            var url = this.$api + '/pesanan'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.pesanan = response.data.data
                this.loading = false
            }).catch(error => {
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
                this.loading = false
            })
        },
        readDataSiap() {
            var url = this.$api + '/pesananSiapSaji'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.pesananSiap = response.data.data
                this.loading = false
            }).catch(error => {
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
                this.loading = false
            })
        },
        changeStatusHandler(item) {
            this.editID = item.id_pesanan
            this.dialogChangeStatus = true
        },
        changeStatus() {
            var url = this.$api + '/status/' + this.editID
            this.load = true
            this.$http.post(url, null, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message = response.data.message;
                this.snackbarSuccess = true;
                this.load = false;
                this.readData(); //mengambil data
                this.readDataSiap();
                this.dialogChangeStatus = false;
            }).catch(error => {
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
                this.dialogChangeStatus = false;
            })
        },
        getStatusColor (status) {
            if (status === 'Belum Disajikan') return 'red'
            else if (status === 'sudah disajikan') return 'green'
            else return 'orange'
        },

        // DETAIL

        readDataDetail(idPesanan) {
            var url = this.$api + '/pesananByMeja/' + idPesanan
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.detailPesanan = response.data.data
                this.dialogDetail = false
            }).catch(error => {
                this.dialogDetail = false
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
            })
        },
        detailHandler(item) {
            this.selectedIDPesanan = item.id_pesanan
            this.selectedNoMeja = item.no_meja
            this.detailPesanan = []   // clean data detail
            this.readDataDetail(this.selectedNoMeja)
        },

    },

    mounted() {
      this.readData();
      this.readDataSiap();
      this.readDataDetail();
    },
}
</script>