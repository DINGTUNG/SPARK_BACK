<script setup>
import { useRouter } from 'vue-router';
const router = useRouter();
</script>

<template>
  <div class="body">
    <div class="title_block">

      <img :src="'pictures/login/shooting_star_white.svg'" alt="shoot" class="shooting_star_white">

      <div class="title_text">
        <img :src="'pictures/login/logo.png'" alt="logo" class="logo">

        <img :src="'pictures/login/shoot.png'" alt="shoot" class="shoot">

      </div>

      </div>
      <div>
        <img class="star_img" :src="'pictures/login/star.svg'" alt="star">
      </div>
    </div>

</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/login/login";
</style>
