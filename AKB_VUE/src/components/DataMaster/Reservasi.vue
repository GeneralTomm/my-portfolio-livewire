<!-- @format -->
  
<template>
<v-main class="list">
<h3 class="text-h3 font-weight-medium mb-5"> Reservasi </h3>

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
        </v-card-title  >
            <v-data-table :headers="headers" :items="Reservasis" :search="search"  class="grey lighten-5">
                <template v-slot:[`item.Qr_Code`]="{ item }">
                    <div class="text-center" style="margin-left: -5vw;">
                    <v-icon small class="mr-2" @click="showQR(item.id_reservasi)" color="blue">
                   mdi-qrcode-scan
                    </v-icon>
                    </div>
                </template>
               <template v-slot:[`item.actions`]="{ item }">
                    <v-icon small class="mr-2" @click="editHandler(item)" color="blue">
                        mdi-pencil
                    </v-icon>
                    <v-icon small @click="deleteHandler(item.id_reservasi)" color="red">
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
            Anda yakin ingin menghapus Reservasi ini?
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
                    v-model="form.tanggal_reservasi"
                    label="Tanggal Reservasi"
                    type="date"
                    :rules="[v => !!v || 'Tanggal Reservasi tidak boleh kosong']"
                    required
                ></v-text-field>

                <v-select
                    v-model="form.sesi_reservasi"
                        :items="items2"
                        :rules="[v => !!v || 'Sesi Reservasi tidak boleh kosong']"
                        label="Sesi Reservasi"
                        required
                ></v-select>
                
                <v-select
                    v-model="form.id_meja"
                    :items="mejas"
                    item-text="no_meja"
                    item-value="id_meja"
                    label="Nomor Meja"
                    :rules="[v => !!v || 'Nomor Meja tidak boleh kosong']"
                    required
                ></v-select>

                <v-select
                    v-model="form.id_customer"
                    :items="customers"
                    item-text="nama_customer"
                    item-value="id_customer"
                    label="Nama Customer"
                    :rules="[v => !!v || 'Nama Customer tidak boleh kosong']"
                    required
                ></v-select>

                <v-select
                    v-model="form.status"
                        :items="items3"
                        :rules="[v => !!v || 'Status Reservasi tidak boleh kosong']"
                        label="Status Reservasi"
                        required
                ></v-select>
                <v-select
                    v-model="form.id_karyawan"
                    :items="karyawans"
                    item-text="nama_karyawan"
                    item-value="id_karyawan"
                    :rules="[v => !!v || 'Karyawan tidak boleh kosong']"
                    label="Nama Karyawan"
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
        </v-card-actions>
    </v-card>
</v-dialog>

 <v-dialog v-model="dialogQR" max-width="500px">
        <v-card id="printMe">
           
        <v-container> 
          <v-row justify="center">
            <img class="mt-5" :src="require('@/assets/AKB.png')" height="150px">
          </v-row>

          <v-row justify="center">
            <img :src="qrURL" height="350px" outlined>
          </v-row>
          
          <v-row justify="center">
              <p style="font-weight: bold;">Printed {{ dateTime }}</p>
          </v-row>

          <v-row justify="center">
            <p>Printed by {{ namaPrinter }}</p>
          </v-row>

            <v-row justify="center">
               <h1 class="text-center">---------------------------------</h1>
                <h1 class="text-center">FUN PLACE TO GRILL</h1>
                <h1 class="text-center">---------------------------------</h1>
            </v-row>
        </v-container>
        <v-card-actions class="btn">
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="cancel">
                Cancel
            </v-btn >
            <v-btn  color="blue darken-1" text @click="printQR()">
                Print
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
import QRCode from 'qrcode';
import html2pdf from 'html2pdf.js';
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
            items2: [
                'Lunch',
                'Dinner',
            ],
            items3: [
                'Belum Selesai',
                'Selesai',
            ],
            headers: [
                { text: "Id",
                align: "start",
                sortable: true,
                value: "id_reservasi" },
                { text: "Nama Customer", value: "nama_customer" },
                { text: "No Telepon", value: "no_hp" },
                { text: "Email Customer", value: "email_customer" },
                { text: "Tanggal", value: "tanggal_reservasi" },
                { text: "No Meja", value: "no_meja" },
                { text: "QR", value: "Qr_Code" },
                { text: "Actions", value: "actions" },
            ],
            Reservasi: new FormData,
            Reservasis: [],
            customers: [],
            mejas: [],
            karyawans:[],
            form: {
                id_customer: null,
                id_meja: null,
                id_karyawan: null,
                tanggal_reservasi: null, 
                sesi_reservasi: null,
                status: null,
            },
            deleteId: '',
            editId: '',  
            dialogQR: false,
            qrURL: '',
            dateTime: '',
            namaPrinter: '',
        };
    },
    methods: {

        printQR(){
            html2pdf(this.$refs.content, {
                filename: "QR Code.pdf",
                image: { type: "PNG", quality: 1 },
                margin: 1,
                html2canvas: { dpi: 200, letterRendering: true },
                jsPDF: { unit: "in", format: "a4", orientation: "p" },
            });
        },
        setForm() {
            if (this.inputType === 'Tambah') {
                this.save()
            } else {
                this.update()
            }
        },
        //read data Customer
        readDataReservasi() {
            var url = this.$api + '/reservasi'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.Reservasis = response.data.data
            })
        },
        readDataMeja() {
            var url = this.$api + '/mejaTersedia'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.mejas = response.data.data
            })
        },
         readDataCustomer() {
            var url = this.$api + '/customer'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.customers = response.data.data
            })
        },
        readDataKaryawan() {
            var url = this.$api + '/karyawanReservasi'
            this.$http.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                } 
            }).then(response => {
                this.karyawans = response.data.data
            })
        },

        //simpan data produk
        save() {

            this.Reservasi.append('id_customer', this.form.id_customer);
            this.Reservasi.append('id_meja', this.form.id_meja);
            this.Reservasi.append('id_karyawan', this.form.id_karyawan);
            this.Reservasi.append('tanggal_reservasi', this.form.tanggal_reservasi);
            this.Reservasi.append('sesi_reservasi', this.form.sesi_reservasi);
            this.Reservasi.append('status', this.form.status);

            var url = this.$api + '/reservasi/'
            this.load = true
            this.$http.post(url, this.Reservasi, {
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.error_message=response.data.message;
                this.color="green"
                this.snackbar=true;
                this.load = false;
                this.close();
                this.readDataReservasi(); //mengambil data
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
                id_customer: this.form.id_customer,
                id_meja :this.form.id_meja,
                id_karyawan :this.form.id_karyawan,
                tanggal_reservasi: this.form.tanggal_reservasi,
                sesi_reservasi : this.form.sesi_reservasi,
                status: this.form.status,
            }
            var url = this.$api + '/reservasi/' + this.editId;
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
                this.readDataReservasi(); //mengambil data
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
            var url = this.$api + '/reservasi/' + this.deleteId;
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
            this.readDataReservasi(); //mengambil data
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
            this.editId = item.id_reservasi;
            this.form.id_customer = item.id_customer ;
            this.form.id_meja= item.id_meja;
            this.form.id_karyawan= item.id_karyawan;
            this.form.tanggal_reservasi = item.tanggal_reservasi;
            this.form.sesi_reservasi = item.sesi_reservasi;
            this.form.status = item.status;
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
            this.readDataReservasi();
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
     showQR(item) {
        var id = item.toString();
        QRCode.toDataURL(id)
          .then(url => {
            this.qrURL = url;
          })
          .catch(err => {
            console.error(err)
          })
        
        var currentdate = new Date(); 
        if((currentdate.getMonth()+1)==1)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Jan" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Jan" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==2)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Feb" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Feb" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==3)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Mar" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Mar" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==4)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Apr" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Apr" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==5)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Mei" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Mei" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==6)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Jun" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Jun" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==7)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Jul" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Jul" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==8)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Ags" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Ags" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==9)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Sep" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Sep" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==10)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Okt" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Okt" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==11)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Nov" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Nov" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }if((currentdate.getMonth()+1)==12)
        {
        if(currentdate.getHours()>=12 && currentdate.getSeconds()>=1 )
        {
            this.dateTime = "Des" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " PM";
        }else{
             this.dateTime = "Des" + " " + currentdate.getDate() + "," + " " 
                        + currentdate.getFullYear() + "  "
                        + currentdate.getHours() + ":"  
                        + currentdate.getMinutes() + ":" 
                        + currentdate.getSeconds() + " AM";
        }
        }

        this.namaPrinter = localStorage.getItem("nama_karyawan");

        this.dialogQR = true;
      },
      
    },
    computed: {
        formTitle() {
            return this.inputType 
        },
    },
    mounted() {
        this.readDataReservasi();
        this.readDataCustomer();
        this.readDataKaryawan();
        this.readDataMeja();
    },
};
</script>