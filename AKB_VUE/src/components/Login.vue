<!-- @format -->

<template>
  <main class="main">
    <v-container fluid fill-height class="posisinya">
      <v-layout flex align-center justify-center>
        <v-flex xs12 sm6 elevation-6>
          <v-toolbar class="ColorList" height="40px" width="500px">
            <v-toolbar-title class="Black--text">
              <h2 > AKB System Log In </h2>
            </v-toolbar-title>
          </v-toolbar>
          <v-card width="500px" class="cardColor">
            <v-card-text class="pt-4">
              <div>
                <v-form v-model="valid" ref="form">
                  <v-text-field
                    label="E-mail"
                    v-model="email"
                    :rules="emailRules"
                    required
                  ></v-text-field>
                  <v-text-field
                    label="Password"
                    v-model="password"
                    type="password"
                    min="6"
                    :rules="passwordRules"
                    counter
                    required
                  ></v-text-field>
                  <v-layout justify-end>
                    <v-btn @click="clear" class=" ColorList white--text"
                      >Clear
                    </v-btn>
                    <v-btn
                      class="cardColor Black--text"
                      @click="submit"
                      >Submit
                    </v-btn>
                  </v-layout>
                </v-form>
              </div>
            </v-card-text>
          </v-card>
          <v-snackbar v-model="snackbar" :color="color" timeout="2000" bottom>
            {{ error_message }}
          </v-snackbar>
        </v-flex>
      </v-layout>
    </v-container>

  </main>
</template>

<style>
.grey--text {
  font-family: "Helvetica";
  font-weight: bold;
}
.posisinya {
  position: absolute;
  top: 0px;
  left: 80px;
  right: 0px;
}
.posisi{
  position: relative;
  left:0px;
   right: 0px;
}

.main{
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  background: url( 'https://c.pxhere.com/photos/8f/8f/abstract_american_background_barbecue_barbeque_bbq_beauty_beef-819785.jpg!d') no-repeat center center;
  background-size: 100%;
  background-color: rgba(0, 0, 0, 0.4) !important;
  background-blend-mode: soft-light;
  transform: scale(1.1);
}
.cardColor {
   background-color: rgba(255, 255, 255, 0.7) !important;
   border-color: red !important;
 }
 .ColorList {
   background-color: rgba(238, 57, 57, 0.9) !important;
   border-color: red !important;
 }
</style>

<script>
export default {
  name: "Login",
  data() {
    return {
      load: false,
      snackbar: false,
      error_message: "",
      color: "",
      valid: false,
      password: "",
      passwordRules: [(v) => !!v || "Password tidak boleh kosong"],
      email: "",
      emailRules: [(v) => !!v || "E-mail tidak boleh kosong"],
    };
  },
  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        //cek apakah data yang akan dikirim sudah valid
        this.load = true;
        this.$http
          .post(this.$api + "/login", {
            email_karyawan: this.email,
            password: this.password,
          })
          .then((response) => {
            if (response.data.user.status === 'non-aktif') {
              alert("Akun sudah Non-Aktif")
            } else {
              localStorage.setItem("current_id", response.data.user.id_karyawan); //menyimpan id user yang sedang login
              localStorage.setItem("nama_karyawan", response.data.user.nama_karyawan);
              localStorage.setItem("current_role", response.data.user.id_role);
              localStorage.setItem("access_token", response.data.access_token); //menyimpan auth token
              this.error_message = response.data.message;
              this.color = "green";
              this.snackbar = true;
              var role=localStorage.getItem('current_role');
              if(role == '1'){
                this.$router.push({
                  name:"KaryawanOwner"
                })
              }
              else if(role == '2'){
                this.$router.push({
                  name:"KaryawanOpm"
                })
              }
              else if(role == '3'){
                this.$router.push({
                  name:"dashboardchef"
                })
              }
              else if(role == '4'){
                this.$router.push({
                  name:"dashboardwaiter"
                })
              }
            }
          })
          .catch((error) => {
            this.error_message = error.response.data.message;
            this.color = "red";
            this.snackbar = true;
            localStorage.removeItem("access_token");
            this.load = false;
          });
      }
    },
    clear() {
      this.$refs.form.reset(); //Clear form login
    },
  },
};
</script>
