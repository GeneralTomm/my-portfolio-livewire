<!-- @format --> 

<template>
    <v-main class="list">
        <h1 class="text-center" style="font-size:30pt">Laporan</h1>
        <br/>
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
      
      <v-tab-item class="grey lighten-3">
          <br/>
        <h1 class="text-center" style="font-size:20pt">LAPORAN PENJUALAN ITEM MENU BERDASARKAN BULAN</h1>
    <div>
          <v-select
              v-model="bulan"
              label="Bulan Penjualan "
              required
              :items="items2"
              v-on:change="getBulan(bulan)"
            ></v-select>

          <v-text-field
              v-model="tahun"
              label="Tahun Penjualan (Dalam Angka) "
              required
              type="number"
              v-on:change="readPenjualanMakananBulanan(tahun,bulan), readPenjualanSideDishBulanan(tahun,bulan), readPenjualanMinumanBulanan(tahun,bulan)"
            ></v-text-field>  
    </div>
<v-row justify="center">
    <v-card>
        <div id="printableArea1" ref="contentPenjualanBulanan">
        <v-card-text class="mt-5 px-10 ">
        <v-img
            :src="require('@/assets/LogoStruk.png')"
            class="mx-auto mt-3"
            max-width="500"
            style="align: middle;"
          />
            <p class="fontBottom mt-1 mb-1">
            -------------------------------------------------------------------------------------------------
            <h1 style="font-size:20pt; text-align: center;">LAPORAN PENJUALAN ITEM MENU</h1>
            <br/>
            <p>
            TAHUN : {{ this.tahun}}
            </p>
            <p>
            BULAN : {{ this.bulanfix }}
            </p>
            <p>
            MAKANAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true" :headers="headersPenjualan" :items="penjualanMakananBulanan"></v-data-table>
            <p>
            SIDE DISH
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPenjualan" :items="penjualanSideDishBulanan"></v-data-table>
            <p>
            MINUMAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPenjualan" :items="penjualanMinumanBulanan"></v-data-table>

            <h1 style="font-size:10pt; text-align: center;">Printed {{ hari_ini }}</h1>
            <h1 style="font-size:6pt; text-align: center;">Printed By: {{ this.karyawan }}</h1>
        
        </v-card-text>
        </div>
        <v-card-actions class="justify-end">
          <v-btn text color="primary" @click="printStrukPenjualanBulanan('printableArea1')">Cetak</v-btn>
        </v-card-actions>
    </v-card>
</v-row>    

<h1 class="text-center" style="font-size:20pt">----------------------------------------------------------------------------------------------------------------------------------------------------------------</h1>

 <br/>
        <h1 class="text-center" style="font-size:20pt">LAPORAN PENJUALAN ITEM MENU BERDASARKAN TAHUN</h1>
    <div>

          <v-text-field
              v-model="tahun"
              label="Tahun Penjualan (Dalam Angka) "
              required
              v-on:change="readPenjualanMakananTahunan(tahun), readPenjualanSideDishTahunan(tahun), readPenjualanMinumanTahunan(tahun)"
            ></v-text-field>  
    </div>
<v-row justify="center">
    <v-card>
        <div id="printableArea2" ref="contentPenjualanTahunan">
        <v-card-text class="mt-5 px-10 ">
        <v-img
            :src="require('@/assets/LogoStruk.png')"
            class="mx-auto mt-3"
            max-width="500"
          />
            <p class="fontBottom mt-1 mb-1">
            -------------------------------------------------------------------------------------------------
            <h1 style="font-size:20pt; text-align: center;">LAPORAN PENJUALAN ITEM MENU</h1>
            <br/>
            <p>
            TAHUN : {{ this.tahun}}
            </p>
            <p>
            BULAN : ALL
            </p>
            <p>
            MAKANAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true" :headers="headersPenjualan" :items="penjualanMakananTahunan"></v-data-table>
            <p>
            SIDE DISH
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPenjualan" :items="penjualanSideDishTahunan"></v-data-table>
            <p>
            MINUMAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPenjualan" :items="penjualanMinumanTahunan"></v-data-table>

            
            <h1 style="font-size:10pt; text-align: center;">Printed {{ hari_ini }}</h1>
            <h1 style="font-size:6pt; text-align: center;">Printed By: {{ this.karyawan }}</h1>
        
        </v-card-text>
        </div>
        <v-card-actions class="justify-end">
          <v-btn text color="primary" @click="printStrukPenjualanTahunan('printableArea2')">Cetak</v-btn>
        </v-card-actions>
    </v-card>
</v-row>    

      </v-tab-item>

      <v-tab-item>
       <br/>
        <h1 class="text-center" style="font-size:20pt">LAPORAN PENDAPATAN BULANAN</h1>
    <div>
          <v-text-field
              v-model="tahun"
              label="Tahun Pendapatan (Dalam Angka) "
              required
              type="number"
              v-on:change="readPendapatanMakananBulanan(tahun), readPendapatanSideDishBulanan(tahun), readPendapatanMinumanBulanan(tahun), readPendapatanBulanan(tahun)  "
            ></v-text-field>  
    </div>
<v-row justify="center">
    <v-card>
        <div id="printableArea3" ref="contentPendapatanBulanan">
        <v-card-text class="mt-5 px-10 ">
        <v-img
            :src="require('@/assets/LogoStruk.png')"
            class="mx-auto mt-3"
            max-width="500"
          />
            <p class="fontBottom mt-1 mb-1">
            -------------------------------------------------------------------------------------------------
            <h1 style="font-size:20pt; text-align: center;">LAPORAN PENDAPATAN BULANAN</h1>
            <br/>
            <p>
            TAHUN : {{ this.tahun}}
            </p>
            <p>
            TOTAL PENDAPATAN MAKANAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true" :headers="headersPendapatan" :items="pendapatanMakananBulanan"></v-data-table>
            <p>
            TOTAL PENDAPATAN SIDE DISH
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPendapatan" :items="pendapatanSideDishBulanan"></v-data-table>
            <p>
            TOTAL PENDAPATAN MINUMAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPendapatan" :items="pendapatanMinumanBulanan"></v-data-table>
            <p>
            TOTAL PENDAPATAN DI SEMUA KATEGORI
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPendapatan" :items="totalPendapatanBulanan"></v-data-table>

            
            <h1 style="font-size:10pt; text-align: center;">Printed {{ hari_ini }}</h1>
            <h1 style="font-size:6pt; text-align: center;">Printed By: {{ this.karyawan }}</h1>
        
        </v-card-text>
        </div>
        <v-card-actions class="justify-end">
          <v-btn text color="primary" @click="printStrukPendapatanBulanan('printableArea3')">Cetak</v-btn>
        </v-card-actions>
    </v-card>
</v-row>    
<h1 class="text-center" style="font-size:20pt">----------------------------------------------------------------------------------------------------------------------------------------------------------------</h1>
 <br/>
        <h1 class="text-center" style="font-size:20pt">LAPORAN PENDAPATAN TAHUNAN</h1>
    <div>

          <v-text-field
              v-model="tahun"
              label="Pendapatan Dari Tahun "
              required
              type="number"
            ></v-text-field>

            <v-text-field
              v-model="tahun2"
              label="Sampai Tahun "
              required
              type="number"
              v-on:change="readPendapatanMakananTahunan(tahun,tahun2), readPendapatanSideDishTahunan(tahun,tahun2), readPendapatanMinumanTahunan(tahun,tahun2), readPendapatanTahunan(tahun,tahun2)  "
            ></v-text-field>

    </div>
<v-row justify="center">
    <v-card>
        <div id="printableArea4" ref="contentPendapatanTahunan">
        <v-card-text class="mt-5 px-10 ">
        <v-img
            :src="require('@/assets/LogoStruk.png')"
            class="mx-auto mt-3"
            max-width="500"
          />
            <p class="fontBottom mt-1 mb-1">
            -------------------------------------------------------------------------------------------------
            <h1 style="font-size:20pt; text-align: center;">LAPORAN PENDAPATAN TAHUNAN</h1>
            <br/>
            <p>
            TAHUN : {{ this.tahun}} s/d {{ this.tahun2}}
            </p>
            <p>
            MAKANAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true" :headers="headersPendapatanTahunan" :items="pendapatanMakananTahunan"></v-data-table>
            <p>
            SIDE DISH
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPendapatanTahunan" :items="pendapatanSideDishTahunan"></v-data-table>
            <p>
            MINUMAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPendapatanTahunan" :items="pendapatanMinumanTahunan"></v-data-table>
            <p>
            TOTAL PENDAPATAN DI SEMUA KATEGORI
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPendapatanTahunan" :items="totalPendapatanTahunan"></v-data-table>

            
            <h1 style="font-size:10pt; text-align: center;">Printed {{ hari_ini }}</h1>
            <h1 style="font-size:6pt; text-align: center;">Printed By: {{ this.karyawan }}</h1>
        
        </v-card-text>
        </div>
        <v-card-actions class="justify-end">
          <v-btn text color="primary" @click="printStrukPendapatanTahunan('printableArea4')">Cetak</v-btn>
        </v-card-actions>
    </v-card>
</v-row>    
      </v-tab-item>

      <v-tab-item>
       <br/>
        <h1 class="text-center" style="font-size:20pt">LAPORAN PENGELUARAN BULANAN</h1>
    <div>
          <v-text-field
              v-model="tahun"
              label="Tahun Pengeluaran (Dalam Angka) "
              required
              type="number"
              v-on:change="readPengeluaranMakananBulanan(tahun), readPengeluaranSideDishBulanan(tahun), readPengeluaranMinumanBulanan(tahun), readPengeluaranBulanan(tahun)  "
            ></v-text-field>  
    </div>
<v-row justify="center">
    <v-card>
        <div id="printableArea5" ref="contentPengeluaranBulanan">
        <v-card-text class="mt-5 px-10 ">
        <v-img
            :src="require('@/assets/LogoStruk.png')"
            class="mx-auto mt-3"
            max-width="500"
          />
            <p class="fontBottom mt-1 mb-1">
            -------------------------------------------------------------------------------------------------
            <h1 style="font-size:20pt; text-align: center;">LAPORAN PENGELUARAN BULANAN</h1>
            <br/>
            <p>
            TAHUN : {{ this.tahun}}
            </p>
            <p>
            TOTAL PENGELUARAN MAKANAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true" :headers="headersPengeluaran" :items="pengeluaranMakananBulanan"></v-data-table>
            <p>
            TOTAL PENGELUARAN SIDE DISH
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPengeluaran" :items="pengeluaranSideDishBulanan"></v-data-table>
            <p>
            TOTAL PENGELUARAN MINUMAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPengeluaran" :items="pengeluaranMinumanBulanan"></v-data-table>
            <p>
            TOTAL PENGELUARAN DI SEMUA KATEGORI
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPengeluaran" :items="totalPengeluaranBulanan"></v-data-table>

            
            <h1 style="font-size:10pt; text-align: center;">Printed {{ hari_ini }}</h1>
            <h1 style="font-size:6pt; text-align: center;">Printed By: {{ this.karyawan }}</h1>
        
        </v-card-text>
        </div>
        <v-card-actions class="justify-end">
          <v-btn text color="primary" @click="printStrukPengeluaranBulanan('printableArea5')">Cetak</v-btn>
        </v-card-actions>
    </v-card>
</v-row>    
<h1 class="text-center" style="font-size:20pt">----------------------------------------------------------------------------------------------------------------------------------------------------------------</h1>
 <br/>
        <h1 class="text-center" style="font-size:20pt">LAPORAN PENGELUARAN TAHUNAN</h1>
    <div>

          <v-text-field
              v-model="tahun"
              label="Pengeluaran Dari Tahun "
              required
              type="number"
            ></v-text-field>

            <v-text-field
              v-model="tahun2"
              label="Sampai Tahun "
              required
              type="number"
              v-on:change="readPengeluaranMakananTahunan(tahun,tahun2), readPengeluaranSideDishTahunan(tahun,tahun2), readPengeluaranMinumanTahunan(tahun,tahun2), readPengeluaranTahunan(tahun,tahun2)  "
            ></v-text-field>

    </div>
<v-row justify="center">
    <v-card>
        <div id="printableArea6" ref="contentPengeluaranTahunan">
        <v-card-text class="mt-5 px-10 ">
        <v-img
            :src="require('@/assets/LogoStruk.png')"
            class="mx-auto mt-3"
            max-width="500"
          />
            <p class="fontBottom mt-1 mb-1">
            -------------------------------------------------------------------------------------------------
            <h1 style="font-size:20pt; text-align: center;">LAPORAN PENGELUARAN TAHUNAN</h1>
            <br/>
            <p>
            TAHUN : {{ this.tahun}} s/d {{ this.tahun2}}
            </p>
            <p>
            MAKANAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true" :headers="headersPengeluaranTahunan" :items="pengeluaranMakananTahunan"></v-data-table>
            <p>
            SIDE DISH
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPengeluaranTahunan" :items="pengeluaranSideDishTahunan"></v-data-table>
            <p>
            MINUMAN
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPengeluaranTahunan" :items="pengeluaranMinumanTahunan"></v-data-table>
            <p>
            TOTAL PENDAPATAN DI SEMUA KATEGORI
            </p>
            <v-data-table  v-if="tahun != null " :hide-default-footer="true"  :headers="headersPengeluaranTahunan" :items="totalPengeluaranTahunan"></v-data-table>

           
            <h1 style="font-size:10pt; text-align: center;">Printed {{ hari_ini }}</h1>
            <h1 style="font-size:6pt; text-align: center;">Printed By: {{ this.karyawan }}</h1>
        
        </v-card-text>
        </div>
        <v-card-actions class="justify-end">
          <v-btn text color="primary" @click="printStrukPengeluaranTahunan('printableArea6')">Cetak</v-btn>
        </v-card-actions>
    </v-card>
</v-row>           
      </v-tab-item>
      
    </v-tabs-items>

   
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
 
import * as moment from 'moment';

export default {
    name: "List",
    data(){
        return{
            tabs: null,
            items: [
           'Laporan Penjualan Menu','Laporan Pendapatan','Laporan Pengeluaran',
        ],
           bulan: '',
           bulanfix: '',
           tahun: '',
           tahun2: '',
            load: false,
            snackbar: false,
            snackbarSuccess:false,
            error_message: '', 
            hari_ini:'',
            karyawan:'',
            color: 'white', 
            search: null,
            
            dialogStruk: false,
            headersPenjualan: [
                {
                text: "Item Menu",
                align: "start",
                sortable: true,
                value: "nama_menu",
                },
                { text: "Unit", value: "unit_menu" },
                { text: "Penjualan Harian Tertinggi", value: "kuantitas_max" },
                { text: "Total Penjualan", value: "Total" },
            ],
            headersPendapatan: [
                {
                text: "Bulan",
                align: "start",
                sortable: true,
                value: "month",
                },
                { text: "Total Pendapatan", value: "Sub_Total" },
            ],
            headersPendapatanTahunan: [
                {
                text: "Tahun",
                align: "start",
                sortable: true,
                value: "year",
                },
                { text: "Total Pendapatan", value: "Sub_Total" },
            ],
            headersPengeluaran: [
                {
                text: "Bulan",
                align: "start",
                sortable: true,
                value: "month",
                },
                { text: "Total Pendapatan", value: "Sub_Total" },
            ],
            headersPengeluaranTahunan: [
                {
                text: "Tahun",
                align: "start",
                sortable: true,
                value: "year",
                },
                { text: "Total Pendapatan", value: "Sub_Total" },
            ],
            penjualanMakananBulanan:[],
            penjualanSideDishBulanan:[],
            penjualanMinumanBulanan:[],
            penjualanMakananTahunan:[],
            penjualanSideDishTahunan:[],
            penjualanMinumanTahunan:[],

            pendapatanMakananBulanan:[],
            pendapatanSideDishBulanan:[],
            pendapatanMinumanBulanan:[],
            totalPendapatanBulanan:[],
            pendapatanMakananTahunan:[],
            pendapatanSideDishTahunan:[],
            pendapatanMinumanTahunan:[],
            totalPendapatanTahunan:[],

            pengeluaranMakananBulanan:[],
            pengeluaranSideDishBulanan:[],
            pengeluaranMinumanBulanan:[],
            totalPengeluaranBulanan:[],
            pengeluaranMakananTahunan:[],
            pengeluaranSideDishTahunan:[],
            pengeluaranMinumanTahunan:[],
            totalPengeluaranTahunan:[],


            items2: [
                { text:'JANUARI', value:'1'}     ,
                { text:'FEBRUARI', value:'2'},
                { text:'MARET', value:'3'},
                { text:'APRIL', value:'4'},
                { text:'MEI', value:'5'},
                { text:'JUNI', value:'6'},
                { text:'JULI', value:'7'},
                { text:'AGUSTUS', value:'8'},
                { text:'SEPTEMBER', value:'9'},
                { text:'OKTOBER', value:'10'},
                { text:'NOVEMBER', value:'11'},
                { text:'DESEMBER', value:'12'},
            ],
            
            mejaRules: [(v) => !!v || "Meja tidak boleh kosong"],
            menuRules: [(v) => !!v || "Menu tidak boleh kosong"],
            jenisPembayaranRules: [
              (v) => !!v || "Jenis pembayaran tidak boleh kosong",
            ],
            kuantitasRules: [(v) => !!v || "Kuantitas tidak boleh kosong"],
            hargaRules: [(v) => !!v || "Harga tidak boleh kosong"],
            tanggalPembayaranRules: [(v) => !!v || "Tanggal tidak boleh kosong"],
            totalRules: [(v) => !!v || "Total harga tidak boleh kosong"],
            pemilikKartuRules: [(v) => !!v || "Nama pemilik tidak boleh kosong"],
            nomorRules: [(v) => !!v || "Nomor kartu tidak boleh kosong"],
            
         
            dateTime: '',
            namaPrinter: '', 
        };
    },
    methods: {
         printStrukPenjualanBulanan(printableArea1) {
            var printContents = document.getElementById(printableArea1).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();

            document.body.innerHTML = originalContents;
      },
      printStrukPenjualanTahunan(printableArea2) {
            var printContents = document.getElementById(printableArea2).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();

            document.body.innerHTML = originalContents;
      },
    //   printStrukPendapatanBulanan(printableArea3) {
    //         var printContents = document.getElementById(printableArea3).innerHTML;
    //         var originalContents = document.body.innerHTML;

    //         document.body.innerHTML = printContents;
    //         window.print();

    //         document.body.innerHTML = originalContents;
    //   },
    //   printStrukPendapatanTahunan(printableArea4) {
    //         var printContents = document.getElementById(printableArea4).innerHTML;
    //         var originalContents = document.body.innerHTML;

    //         document.body.innerHTML = printContents;
    //         window.print();

    //         document.body.innerHTML = originalContents;
    //   },
    //   printStrukPengeluaranBulanan(printableArea5) {
    //         var printContents = document.getElementById(printableArea5).innerHTML;
    //         var originalContents = document.body.innerHTML;

    //         document.body.innerHTML = printContents;
    //         window.print();

    //         document.body.innerHTML = originalContents;
    //   },
    //   printStrukPengeluaranTahunan(printableArea6) {
    //         var printContents = document.getElementById(printableArea6).innerHTML;
    //         var originalContents = document.body.innerHTML;

    //         document.body.innerHTML = printContents;
    //         window.print();

    //         document.body.innerHTML = originalContents;
    //   },
      getBulan (bulan) {
        if (bulan=="1") 
            return this.bulanfix = 'JANUARI'
        else if (bulan=="2")  
            return this.bulanfix = 'FEBRUARI'
        else if (bulan=="3")  
            return this.bulanfix = 'MARET'
        else if (bulan=="4")  
            return this.bulanfix = 'APRIL'
        else if (bulan=="5")  
            return this.bulanfix = 'MEI'
        else if (bulan=="6")  
            return this.bulanfix = 'JUNI'
        else if (bulan=="7")  
            return this.bulanfix = 'JULI'
        else if (bulan=="8")  
            return this.bulanfix = 'AGUSTUS'
        else if (bulan=="9")  
            return this.bulanfix = 'SEPTEMBER'
        else if (bulan=="10")  
            return this.bulanfix = 'OKTOBER'
        else if (bulan=="11")  
            return this.bulanfix = 'NOVEMBER'
        else if (bulan=="12")  
            return this.bulanfix = 'DESEMBER'                                        
        },
        setForm() {
            if (this.inputType === 'Tambah') {
                this.save()
            } else {
                this.update()
            }
        },

         readPenjualanMakananBulanan(tahun,bulan) {
            var url = this.$api + '/PenjualanMakananPerBulan/' + tahun + ',' + bulan
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.hari_ini = moment().format("MMM DD, YYYY h:mm:ss A");
                this.penjualanMakananBulanan = response.data.data
                
            }).catch(error => {
                this.dialogDetail = false
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
            })
        },

        readPenjualanSideDishBulanan(tahun,bulan) {
            var url = this.$api + '/PenjualanSideDishPerBulan/' + tahun + ',' + bulan
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.penjualanSideDishBulanan = response.data.data
                
            }).catch(error => {
                this.dialogDetail = false
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
            })
        },

        readPenjualanMinumanBulanan(tahun,bulan) {
            var url = this.$api + '/PenjualanMinumanPerBulan/' + tahun + ',' + bulan
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.penjualanMinumanBulanan = response.data.data
                
            }).catch(error => {
                this.dialogDetail = false
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
            })
        },

        readPenjualanMakananTahunan(tahun) {
            var url = this.$api + '/PenjualanMakananPerTahun/' + tahun 
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.hari_ini = moment().format("MMM DD, YYYY h:mm:ss A");
                this.penjualanMakananTahunan = response.data.data
                
            }).catch(error => {
                this.dialogDetail = false
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
            })
        },

        readPenjualanSideDishTahunan(tahun) {
            var url = this.$api + '/PenjualanSideDishPerTahun/' + tahun 
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.penjualanSideDishTahunan = response.data.data
                
            }).catch(error => {
                this.dialogDetail = false
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
            })
        },

        readPenjualanMinumanTahunan(tahun) {
            var url = this.$api + '/PenjualanMinumanPerTahun/' + tahun 
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.penjualanMinumanTahunan = response.data.data
                
            }).catch(error => {
                this.dialogDetail = false
                this.error_message = error.response.data.message;
                this.color = "red"
                this.snackbar = true;
                this.load = false;
            })
        },

        


        close() {
            this.dialog = false
            this.inputType = 'Tambah';
        },
        closeInfo() {
            this.dialogInfo = false
            this.inputType = 'Tambah';
        },
        cancel() {
            this.resetForm();
            this.readTransaksi();
            this.readPesanan();
            this.dialog = false;
            this.inputType = "Tambah";
        },
        cancelInfo() {
            this.resetForm2();
            this.readInfo();
            this.dialogInfo = false;
            this.inputType1 = "Tambah";
        },
        resetForm() {
           this.detailPesananNoMeja=[null],
           this.no_meja = null,
            this.form = {
                kode_pembayaran: '',
                id_pesanan: 'null',
                id_pegawai: '',
                jenis_pembayaran: '',
                kode_verifikasi: '',
                tanggal_pembayaran: '',
                nomor_kartu: '',
                status_lunas: 'Lunas',
                total: '',
            };
        },
    
         showStruk(item) {
            this.nama = item.nama_karyawan;
            this.id = item.id_transaksi;
            this.no_transaksi = item.no_transaksi;
            this.id_transaksi = item.id_transaksi;
            this.id_pesanan = item.id_pesanan;
            this.nama_customer = item.nama_customer;
            this.no_meja = item.no_meja;
            this.tanggal_transaksi = item.tanggal_transaksi;
            this.subtotal_pesanan = item.subtotal_pesanan;
            this.service = item.service;
            this.tax = item.tax;
            this.total_pesanan = item.total_pesanan;
            this.qty = item.total_qty;
            this.total_item = item.total_item; 
            this.dialogStruk = true;
            this.hari_ini = moment().format("MMM DD, YYYY h:mm:ss A");

            this.time = moment().format("HH:mm");
            },       
            },
    computed: {
        formTitle(){
            return this.inputType
        },
    },
    mounted() {
        
        this.karyawan = localStorage.getItem('nama_karyawan')
    },
};

</script>

<style scoped>

.teksPosition {
  text-align: left;
  float: left;
}
.teksPosition2 {
  text-align: end;
}
.teksPositionKanan1 {
  text-align: right;
  float: right;
}

.teksHarga{
  text-align: right;
}

.font1 {
  font-family: "Fredoka One", cursive;
  font-size: 18px;
  color: black;
}
.font2 {
  font-family: "Fredoka One", cursive;
  font-size: 15px;
  color: rgb(53, 52, 52);
}
.font3 {
  font-family: "Fredoka One", cursive;
  font-size: 12px;
  color: rgb(53, 52, 52);
}

.fontBottom {
  font-family: serif;
  font-size: 18px;
  color: #000000;
  text-align: center;
}

</style>


