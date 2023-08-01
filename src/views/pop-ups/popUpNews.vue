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
          <form action="">
            <label for="">標題
              <input type="text">
            </label>
            <label for="">日期
              <input type="date">
            </label>
            <label for="">段落1
              <textarea name="" id="" cols="70" rows="10"></textarea>
            </label>
            <div class="imgblock">
              <span>圖檔1</span>
              <v-file-input variant="outlined" id="book" prepend-icon="none">
                <template v-slot:prepend-inner>
                  <label for="book">上傳圖檔</label>
                </template>
              </v-file-input>
            </div>
            <label for="">段落2
              <textarea name="" id="" cols="70" rows="10"></textarea>
            </label>
            <div class="imgblock">
              <span>圖檔2</span>
              <v-file-input variant="outlined" id="book" prepend-icon="none">
                <template v-slot:prepend-inner>
                  <label for="book">上傳圖檔</label>
                </template>
              </v-file-input>
            </div>
            <label for="">段落3
              <textarea name="" id="" cols="70" rows="10"></textarea>
            </label>
            <div class="imgblock">
              <span>圖檔3</span>
              <v-file-input variant="outlined" id="book" prepend-icon="none">
                <template v-slot:prepend-inner>
                  <label for="book">上傳圖檔</label>
                </template>
              </v-file-input>
            </div>
            <label for="">段落4
              <textarea name="" id="" cols="70" rows="10"></textarea>
            </label>
            <div class="imgblock">
              <span>圖檔4</span>
              <v-file-input variant="outlined" id="book" prepend-icon="none">
                <template v-slot:prepend-inner>
                  <label for="book">上傳圖檔</label>
                </template>
              </v-file-input>
            </div>
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


:deep(.imgblock[data-v-bea6dedf] .v-field.v-field--appended){
  position: relative;
  right: 20px;
}

.text-h5 {
  color: $primaryBrandBlue;
  @include h5_PC;
  font-weight: 900;

}

.imgblock {
  display: flex;

  span {
    @include flex_vm();
    justify-content: start;
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

  :deep(.v-field.v-field--appended) {
    display: flex;
  }

  :deep(.v-input__control) {
    width: 50%;
    height: 5vh;
  }

  label{
    @include flex_vm();
    margin-bottom: 0;
    position: relative;
    left: 22vw;
    padding: 10px;
    background-color: $primaryBrandBlue;
    border-radius: 50px;
    width: 6vw;
    color: #ffff;
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



:deep(.v-field__outline) {
  border: 1px solid;
  border-radius: $br_MB;
}

:deep(.v-btn.v-btn--density-default) {
  background-color: $primaryBrandBlue !important;
  width: 5.5vw;
  height: 6vh;
  border-radius: 50px;
  margin-bottom: 50px;
  margin-right: 20px;

}
</style>