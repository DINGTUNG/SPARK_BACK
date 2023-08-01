<script setup>
import { useRouter } from 'vue-router';
const router = useRouter();
</script>

<template>
  <div class="login_container">
    <img :src="'pictures/login/shooting_star_white.svg'" alt="shooting_star_white" class="shooting_star_white">
    <img :src="'pictures/login/logo.png'" alt="logo" class="logo">
    <img :src="'pictures/login/shooting_star_gold.png'" alt="shooting_star_gold" class="shooting_star_gold">
    <img :src="'pictures/login/three_stars.svg'" alt="three_stars" class="three_stars" >



  </div>



  <!-- <div class="login_wrap">

      <h2>後台登入</h2>
      <form action="" method="">
        <label for="account">帳號</label>
        <input type="text" class="account" v-model="account" placeholder="輸入您的帳號或信箱"
          :class="{ 'animate__animated animate__headShake': errorAccount }" name="memId">
        <label for="password">密碼</label>
        <div class="password_wrapper" ref="passwordField"
          :class="{ 'animate__animated animate__headShake': errorAccount }">
          <div class="password_block">
            <input :type="showPassword ? 'password' : 'text'" class="password" v-model="password" placeholder="輸入您的密碼"
              name="memPsw">
            <span class="toggle" @click="showHide"> <img v-if="showPassword" :src="'pictures/images/login/eye_hide.svg'"
                alt="hide" />
              <img v-else :src="'pictures/images/login/eye_show.svg'" alt="show" /></span>
          </div>
          <div class="recaptcha_forget_block">
            <div class="forgot_psw">
              <i class="fa-solid fa-circle-question"></i>
              <a href="#">忘記密碼</a>
            </div>
          </div>
        </div>
        <div v-if="errorAccount" class="error_account">
          {{ errorAccount }}
        </div>
      </form>
    </div> -->
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/login/login";
</style>
