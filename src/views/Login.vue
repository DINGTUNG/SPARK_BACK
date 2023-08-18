<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
const router = useRouter();
const showPassword = ref(true);
const passwordField = ref(null);


function showHide() {
  if (passwordField.value.type === 'password') {
    passwordField.value.type = 'password';
  } else {
    passwordField.value.type = 'text';
  }
  // 切換顯示密碼圖標
  showPassword.value = !showPassword.value;
}

const account = ref('');
const password = ref('');
const errorAccount = ref('');

const handleLogin = async () => {
    try {
        const formData = new FormData();
        formData.append('staff_account', account.value);
        formData.append('staff_password', password.value);
        const res = await axios.post('https://tibamef2e.com/chd102/g3/back-end/php/backstage_management/handle_login.php', formData,{ withCredentials: true});
        if (res.data.status === "ok") {
            router.push({ path: '/home' });
        } else {
            const msg = res.data.msg;
            errorContent.value = msg;
        }
    } catch (error) {
        console.error('網路請求錯誤:', error);
        alert('網路請求錯誤');
    }
}



</script>

<template>
  <div class="login_container">
    <img :src="'pictures/login/shooting_star_white.svg'" alt="shooting_star_white" class="shooting_star_white">
    <img :src="'pictures/login/logo.png'" alt="logo" class="logo">
    <img :src="'pictures/login/shooting_star_gold.png'" alt="shooting_star_gold" class="shooting_star_gold">
    <img :src="'pictures/login/three_stars.svg'" alt="three_stars" class="three_stars">

    <div class="login_wrap">
      <h2>後台登入</h2>
      <form action="" method="">

        <div class="account_wrap">
          <label for="account">帳號</label>
          <input type="text" class="account"  v-model="account" placeholder="請輸入您的帳號"
            :class="{ 'animate__animated animate__headShake': errorAccount }">
        </div>
        <div class="password_wrap">
          <label for="password">密碼</label>
          <input :type="showPassword ? 'password' : 'text'" class="password" v-model="password" placeholder="輸入您的密碼"
              autocomplete="current-password">
          <span class="toggle" @click="showHide">
            <img class="eye" v-if="showPassword" :src="'pictures/login/eye_hide.svg'" alt="hide" />
            <img v-else class="eye" :src="'pictures/login/eye_show.svg'" alt="show" /></span>
          <div class="password_wrapper" ref="passwordField"
            :class="{ 'animate__animated animate__headShake': errorAccount }">
          </div>
        </div>
        <div class="btn_wrapper">
          <button class="login_btn" type="button" @click="handleLogin">登入
          </button>
        </div>


        <div v-if="errorAccount" class="error_account">
          {{ errorAccount }}
        </div>

      </form>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/login/login";
</style>
