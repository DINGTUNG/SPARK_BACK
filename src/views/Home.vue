<script setup>
import { useRouter } from 'vue-router';
const router = useRouter();

</script>

<template>
  <div class="container">
    <div class="test" @click="router.push({ path: '/test' })">test</div>
    <img :src="'pictures/home/cms_home.png'" alt="">
  </div>
</template>

<style scoped lang="scss">
div.container {
  .test {
    position: absolute;
    top: 50%;
    left: 50%;
    font-size: 100px;
  }

  img {
    width: 100vw;
    height: 100vh;
  }

}
</style>
