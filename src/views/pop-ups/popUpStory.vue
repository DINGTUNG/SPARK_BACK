<script setup>
import { ref, reactive, computed } from 'vue'
const dialog = ref(false);


// const fileName = ref("");

// function onFileChange(event) {
//   // 更新檔案名稱
//   fileName.value = event.target.files[0]?.name || "";
// }
</script>

<template>
  <v-row justify="end">
    <v-dialog v-model="dialog" persistent width="50%">
      <template v-slot:activator="{ props }">
        <v-btn color="primary" v-bind="props">
          新增
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">新增消息</span>
        </v-card-title>
        <v-card-text>
          <form action="../../../public/php/results/story.php">
            <label for="">標題
              <input type="text" name="story_title">
            </label>
            <label for="">日期
              <input name="story_date" type="date">
            </label>
            <div class="imgblock">
              <span>圖檔</span>
              <input type="file" name="story_image" id="upImg">
              <label for="upImg">上傳圖檔</label>
            </div>
            <label for="">
              <textarea name="story_brief" cols="70" rows="10"></textarea>
            </label>
            <label for="">段落1
              <textarea name="story_detail" cols="70" rows="10"></textarea>
            </label>
            <label for="">段落2
              <textarea name="story_detail_second" cols="70" rows="10"></textarea>
            </label>
            <label for="">段落3
              <textarea name="story_detail_third" cols="70" rows="10"></textarea>
            </label>
          </form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
            取消
          </v-btn>
          <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
            儲存
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<style scoped lang="scss">
:deep(.v-dialog > .v-overlay__content) {
  width: 50%;
}

:deep(.v-card.v-theme--light.v-card--density-default.v-card--variant-elevated) {
  height: 50%;
  top: 50%;
}

:deep(.v-btn__content) {
  color: #ffff !important;
}

:deep(.v-card .v-card-title) {
  padding: 20px;
  text-align: center;
}

:deep(.v-dialog > .v-overlay__content > .v-card > .v-card-text) {
  padding: 500px;
}

.text-h5 {
  color: $primaryBrandBlue;
  @include h5_PC;
  font-weight: 900;

}

.imgblock {
  display: flex;

  input[type="file"] {
    border: 1px transparent;
  }


  input {
    height: 5vh;
    padding-left: 10px;
    padding-top: 5px;
    margin-left: 1vw;
    width: 2vw;
    width: 50%;
    border: 1px solid;
    border-radius: $br_MB;
  }

}

input {
  height: 5vh;
  padding-left: 10px;
  padding-top: 5px;
  margin-left: 1vw;
  width: 2vw;
  width: 50%;
  border: 1px solid;
  border-radius: $br_MB;
}

label {
  margin-bottom: 20px;
  display: flex;

  textarea {
    margin-left: 1vw;
    border: 1px solid;
    padding-left: 10px;
    padding-top: 10px;
    border-radius: $br_MB;

  }
}

:deep(.v-btn.v-btn--density-default) {
  background-color: $primaryBrandBlue !important;
  width: 5.5vw;
  height: 6vh;
  border-radius: 50px;
  margin-bottom: 50px;
  margin-right: 20px;

}


// #upImg {
//     opacity: 0;
//     position: absolute;
//     z-index: -1;
//   }
</style>