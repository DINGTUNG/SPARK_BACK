<script setup>
import { useRouter } from 'vue-router';
const router = useRouter();
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
          <input type="text" class="account"  v-model="account" placeholder="請輸入您的帳號或信箱"
            :class="{ 'animate__animated animate__headShake': errorAccount }" name="memId" >
        </div>


        <div class="password_wrap">
          <label for="password">密碼</label>
          <input :type="showPassword ? 'password' : 'text'" class="password" v-model="password" placeholder="請輸入您的密碼"
            name="memPsw" value="87878787">
          <span class="toggle" @click="showHide">
            <img class="eye" v-if="showPassword" :src="'pictures/login/eye_hide.svg'" alt="hide" />
            <img v-else class="eye" :src="'pictures/login/eye_show.svg'" alt="show" /></span>
          <div class="password_wrapper" ref="passwordField"
            :class="{ 'animate__animated animate__headShake': errorAccount }">
          </div>
        </div>
        <div class="btn_wrapper">
          <button class="login_btn" @click="router.push({ path: '/home' })">登入
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
