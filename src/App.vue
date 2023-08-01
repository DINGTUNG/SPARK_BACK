<script setup>
import { RouterView,useRoute } from 'vue-router'
import SideBar from '@/layout/SideBar.vue';

const route = useRoute();

</script>

<template>
  <SideBar v-if="!route.meta.hideSideBar"/>
  <RouterView />
</template>

<style scoped></style>
