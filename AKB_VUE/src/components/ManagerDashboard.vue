<!-- @format -->

<template>
    <div class="dashboard">
        <v-navigation-drawer v-model="drawer" width="250" app>
             <v-list-item>
                 <v-img :src="AKB" class="img"></v-img>
             </v-list-item>

             <v-divider></v-divider>

             <v-list dense nav>
                 <v-list-item
                     v-for="item in items"
                     :key="item.title"
                     link
                     tag="router-link"
                     :to="item.to"
                    >
                     <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                        <v-icon class="iconstyle">{{item.icon}}</v-icon>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
    <v-app-bar class ="red lighten" app fixed height="50px">
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <VSpacer />
        <v-toolbar-items>
            <v-btn text router @click="logout()"><v-icon>mdi-logout</v-icon></v-btn>
        </v-toolbar-items>
    </v-app-bar>
    <div class="fullheight pa-5">
        <router-view></router-view>
      </div>
    </div>
 </template>
 <script>
 export default {
    name: "Dashboard",
    data() {
        return {
            drawer: true,
            items: [
                { title: "Daftar Menu",icon:"mdi-food", to: "/menuOpm" },
                { title: "Meja",icon:"mdi-desk", to: "/mejaOpm" },
                { title: "Karyawan",icon:"mdi-face-agent", to: "/karyawanOpm" },
                { title: "Customer",icon:"mdi-account-group", to: "/customerOpm" },
                { title: "Reservasi",icon:"mdi-notebook-check", to: "/reservasiOpm" },
                { title: "Stok Bahan",icon:"mdi-sack-percent", to: "/bahanOpm" },
                { title: "Histori Stok",icon:"mdi-timetable", to: "/historistokOpm" },
                { title: "Transaksi",icon:"mdi-cash-register", to: "/transaksiOpm" },
                { title: "Pesanan",icon:"mdi-credit-card-check-outline", to: "/pesananOpm" },
                { title: "Laporan",icon:"mdi-notebook-multiple", to: "/laporanOpm" },
            ],
            AKB:require('../assets/AKB.png'),
        };
    },
    methods: {
        logout() {
            localStorage.removeItem('access_token');
            this.$router.push({
                name:'Login',
            });
        },

    },
 };
 </script>

<style scoped>
 .fullheight {
    min-height: 100vh !important;
 }
 .router {
text-decoration: none; 
 color: black;
 }
 .akbstyle{
    min-height: 100vh !important;
    color:rgb(155, 175, 233) 
 }
 .iconstyle{
     color:rgb(236, 38, 38);
     position: fixed;
 }
 </style> 