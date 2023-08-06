<script setup>
import { defineProps } from 'vue'


const props = defineProps({
  placeholder: String,
})

</script>

<template>
  <div class="search_container">

    <form action="">
      <label for="">查詢</label>
      <input class="search" type="text" :placeholder="props.placeholder">
      <v-icon class="icon" size="large">mdi-magnify</v-icon>
    </form>
  </div>
</template>

<style scoped lang="scss">
div.search_container {
  width: 20vw;

  form {

    label {
      margin: 0 1vw;
      font-size: 1.2vw;
      font-weight: bold;
      color: $primaryBrandBlue;
    }

    input.search {
      padding: 1vw 0.5vw;
      width: 15vw;
      height: 5vh;
      border: 2px solid $primaryBrandBlue;
      border-radius: 10px;
    }

    input {
      outline: 0;
    }

    input:focus {
      border: 3px solid $primaryBrandBlue;
    }

    ::placeholder {
      color: $basicFontColor;
      opacity: 0.8;
    }

    .icon {
      color: $primaryBrandBlue;
      cursor: pointer;
      position: absolute;
      top: 1vh;
      right: 1.5vw;

      @include btnEffect;
    }
  }



}
</style>
