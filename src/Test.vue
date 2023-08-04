<script setup>
import axios from 'axios';



async function testConnection() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/try.php');
    document.write(response.data)
    console.log(response.data);
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
