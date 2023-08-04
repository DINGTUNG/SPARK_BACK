<script setup>
import { ref } from 'vue'
import axios from 'axios';

const message = ref("");

async function sendMessage() {
  try {
    const response = await axios.post('http://localhost:5173/php/api.php');
    message.value = response.data.data;
    console.log("成功");
  } catch (error) {
    console.error(error);
  }
}

</script>

<template>
  <div>
    <input type="text" v-model="message" placeholder="Enter a message">
    <button @click="sendMessage">Send Message</button>
  </div>
</template>

<style scoped lang="scss"></style>
