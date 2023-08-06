<script setup>
import axios from 'axios';



async function testConnection() {
  try {
    const response = await axios.post('http://localhost:5173/php/api.php');
    message.value = response.data;
    console.log("成功");
    console.log(response.data)
  } catch (error) {
    console.error(error);
  }
}

</script>

<template>
  <div>
    <button @click="testConnection">testConnection</button>
  </div>
</template>

<style scoped lang="scss"></style>
