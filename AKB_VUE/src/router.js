import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

function importComponent(path) {
    return () => import(`./components/${path}.vue`)
}

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        
        
        {
            path: "/dash",
            name: "dashboardowner",
            meta: { title: 'Dashboard' },
            component: importComponent('OwnerDashboard'),
            children: [
                
                // Admin
                {
                    path: "/laporanOwner",
                    name: "LaporanOwner",
                    meta: { title: 'Laporan' },
                    component: importComponent('DataMaster/Laporan'),
                },
                {
                    path: "/karyawan",
                    name: "KaryawanOwner",
                    meta: { title: 'Karyawan' },
                    component: importComponent('DataMaster/Karyawan'),
                },
                
            ]
        },

        {
            path: "/dashmanager",
            name: "dashboardmanager",
            meta: { title: 'Dashboard' },
            component: importComponent('ManagerDashboard'),
            children: [
                //Dashboard
            
                // Admin
                {
                    path: "/laporanOpm",
                    name: "LaporanOpm",
                    meta: { title: 'Cetak Laporan' },
                    component: importComponent('DataMaster/Laporan'),
                },
                {
                    path: "/karyawanOpm",
                    name: "KaryawanOpm",
                    meta: { title: 'Data Karyawan' },
                    component: importComponent('DataMaster/Karyawan'),
                },
                {
                    path: "/reservasiOpm",
                    name: "Reservasi",
                    meta: { title: 'Kelola Reservasi' },
                    component: importComponent('DataMaster/Reservasi'),
                },
                {
                    path: "/mejaOpm",
                    name: "MejaOpm",
                    meta: { title: 'Kelola Meja' },
                    component: importComponent('DataMaster/Meja'),
                },
                {
                    path: "/menuOpm",
                    name: "MenuOpm",
                    meta: { title: 'Data Menu' },
                    component: importComponent('DataMaster/Menu'),
                },
                {
                    path: "/customerOpm",
                    name: "CustomerOpm",
                    meta: { title: 'Data Customer' },
                    component: importComponent('DataMaster/Customer'),
                },
                {
                    path: "/historistokOpm",
                    name: "HistoriStok",
                    meta: { title: 'Kelola Histori Stok' },
                    component: importComponent('DataMaster/HistoriStok'),
                },
                {
                    path: "/bahanOpm",
                    name: "BahanOpm",
                    meta: { title: 'Kelola Bahan' },
                    component: importComponent('DataMaster/Bahan'),
                },
                {
                    path: "/PesananOpm",
                    name: "PesananOpm",
                    meta: { title: 'Kelola Pesanan' },
                    component: importComponent('DataMaster/Pesanan'),
                },
                {
                    path: "/TransaksiOpm",
                    name: "TransaksiOpm",
                    meta: { title: 'Kelola Transaksi' },
                    component: importComponent('DataMaster/Transaksi'),
                },
            ]
        },
        {
            path: "/chef",
            name: "chef",
            meta: { title: 'Dashboard' },
            component: importComponent('DashboardLayoutChef'),
            children: [
                //Dashboard
                {
                    path: "",
                    name: "DashboardChef",
                    meta: { title: 'Dashboard Chef' },
                    component: importComponent('Chef/DashboardChef'),
                },
                {
                    path: "/lihatMejaChef",
                    name: "LihatMejaChef",
                    meta: { title: 'Lihat Meja' },
                    component: importComponent('LihatMeja'),
                },
                {
                    path: "/stokbahanChef",
                    name: "StokBahanChef",
                    meta: { title: 'Kelola Stok Bahan' },
                    component: importComponent('Chef/StokBahan'),
                },
                {
                    path: "/bahanChef",
                    name: "BahanChef",
                    meta: { title: 'Kelola Bahan' },
                    component: importComponent('Chef/Bahan'),
                },
                {
                    path: "/profileChef",
                    name: "ProfileChef",
                    meta: { title: "Profile" },
                    component: importComponent('Profile'),
                },
            ]
        },
        {
            path: "/dashboardwaiter",
            name: "dashboardwaiter",
            meta: { title: 'Dashboard' },
            component: importComponent('WaiterDashboard'),
            children: [
                //Dashboard
                
                // {
                //     path: "/reservasiWaiter",
                //     name: "ReservasiWaiter",
                //     meta: { title: 'Kelola Reservasi' },
                //     component: importComponent('Opm/Reservasi'),
                // },
                {
                    path: "/customerWaiter",
                    name: "CustomerWaiter",
                    meta: { title: 'Kelola Customer' },
                    component: importComponent('DataMaster/Customer'),
                },
                // {
                //     path: "/lihatMejaWaiter",
                //     name: "LihatMejaWaiter",
                //     meta: { title: 'Lihat Meja' },
                //     component: importComponent('LihatMeja'),
                // },
                {
                    path: "/menuWaiter",
                    name: "MenuWaiter",
                    meta: { title: 'Lihat Menu' },
                    component: importComponent('DataMaster/Menu'),
                },
                // {
                //     path: "/profileWaiter",
                //     name: "ProfileWaiter",
                //     meta: { title: "Profile" },
                //     component: importComponent('Profile'),
                // },
            ]
        },
        {
            path: "/cashier",
            name: "cashier",
            meta: { title: 'Dashboard' },
            component: importComponent('DashboardLayoutCashier'),
            children: [
                //Dashboard
                {
                    path: "",
                    name: "DashboardCashier",
                    meta: { title: 'Dashboard Cashier' },
                    component: importComponent('Cashier/DashboardCashier'),
                },
                {
                    path: "/reservasiCashier",
                    name: "ReservasiCashier",
                    meta: { title: 'Kelola Reservasi' },
                    component: importComponent('Cashier/Reservasi'),
                },
                {
                    path: "/customerCashier",
                    name: "CustomerCashier",
                    meta: { title: 'Kelola Customer' },
                    component: importComponent('Cashier/Customer'),
                },
                {
                    path: "/lihatMejaCashier",
                    name: "LihatMejaCashier",
                    meta: { title: 'Lihat Meja' },
                    component: importComponent('LihatMeja'),
                },
                {
                    path: "/lihatMenuCashier",
                    name: "LihatMenuCashier",
                    meta: { title: 'Lihat Menu' },
                    component: importComponent('LihatMenu'),
                },
                {
                    path: "/profileCashier",
                    name: "ProfileCashier",
                    meta: { title: "Profile" },
                    component: importComponent('Profile'),
                },
            ]
        },
        {
            path: '*',
            redirect: '/',
        },
        {
            path: "/",
            name: "Login",
            meta: { title: 'AKB Sistem' },
            component: importComponent('Login'),
        },
        
    {
        path:'*',
        redirect: '/'
    },
]
});
//mengset judul
router.beforeEach((to, from, next)=>{
    document.title = to.meta.title
    next()
});

router.beforeResolve((to, from, next) => {
    if (to.meta.restriction && localStorage.getItem("id_karyawan") == null) {
      next("/login");
    } else next();
  });
export default router;