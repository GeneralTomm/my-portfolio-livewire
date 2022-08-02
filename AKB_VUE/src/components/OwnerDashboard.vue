<!-- @format -->

<template>
    <div class="grey lighten-3">
        <v-navigation-drawer v-model="drawer" class="grey lighten-3" width="245" app>
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
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
    <v-app-bar class ="red lighten-1" app fixed height="60px">
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <VSpacer />
        <!-- <h1 class="posisiText">Atma Korean BBQ System</h1> -->
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
                { title: "Karyawan",icon:"mdi-account", to: "/karyawan" },
                { title: "Laporan", to: "laporan" },
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
 .img{
    width: 100%; 
 }
 .posisiText{
    position: relative;
    right: 550px; 
 }
 </style> 