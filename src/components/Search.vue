<script setup></script>

<template>
  <div class="search_container">
  
    <form action="">
      <label for="">查詢</label>
      <input class="search" type="text">
    </form>
  </div>
</template>

<style scoped lang="scss">
div.search_container {
  width: 15vw;


  form {
    
  label {
    font-size: 1.2vw;
    font-weight: bold;
    color: $primaryBrandBlue;
  }
    input.search {
      width: 10vw;
      height: 4vh;
      border: 1px solid $primaryBrandBlue;
    }
  }



}
</style>
