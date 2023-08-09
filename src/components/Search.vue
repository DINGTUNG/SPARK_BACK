<script setup>
import { defineProps, defineEmits, ref } from 'vue'

const props = defineProps({
  placeholder: String,
  searchValue: {
    type: String,
    default: ''
  }
})

const emit = defineEmits(['search']); // 定義 search 事件

function handleSearch(e) {
  const newValue = e.target.value;
  emit('search', newValue);
}

function performSearch() {
  emit('search', props.searchValue);
}
</script>


<template>
  <div class="search_container">
    <div class="search_inner">
      <label for="">查詢</label>
      <input class="search" type="text" :placeholder="props.placeholder" @change="handleSearch">
      <v-icon class="icon" size="large" @click="performSearch">mdi-magnify</v-icon>
    </div>
  </div>
</template>

<style scoped lang="scss">
div.search_container {
  width: 20vw;

  div.search_inner {
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
