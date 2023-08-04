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
            <div class="form_item">
             <div class="name"><span>標題</span></div>
              <input type="text" id="title">
            </div>
            <div class="form_item">
              <div class="name"><span>日期</span></div>
              <input type="date" id="date">
            </div>                       
            <div class="form_item">
              <div class="name"><span>段落1</span></div>
              <textarea id="paragraph1" cols="70" rows="10"></textarea>
            </div>
            <div class="imgblock form_item">
              <div class="name"><span>圖檔1</span></div>
              <v-file-input  id="photo1" prepend-icon="none">
                <template v-slot:prepend-inner>
                  <label for="photo1" id="photo">上傳圖檔</label>
                </template>
              </v-file-input>
            </div>
            <div class="form_item">
              <div class="name"><span>段落2</span></div>
              <textarea id="paragraph2" cols="70" rows="10"></textarea>
            </div>
            <div class="imgblock form_item">
              <div class="name"><span>圖檔2</span></div>
              <v-file-input  id="photo2" prepend-icon="none">
                <template v-slot:prepend-inner>
                  <label for="photo2" id="photo">上傳圖檔</label>
                </template>
              </v-file-input>
            </div>
            <div class="form_item">
              <div class="name"><span>段落3</span></div>
              <textarea id="paragraph3" cols="70" rows="10"></textarea>
            </div>
            <div class="imgblock form_item">
              <div class="name"><span>圖檔3</span></div>
              <v-file-input id="photo3" prepend-icon="none">
                <template v-slot:prepend-inner>
                  <label for="photo3" id="photo">上傳圖檔</label>
                </template>
              </v-file-input>
            </div>
            <div class="form_item">
              <div class="name"><span>段落4</span></div>
              <textarea id="paragraph4" cols="70" rows="10"></textarea>
            </div>
            <div class="imgblock form_item">
              <div class="name"><span>圖檔4</span></div>
              <v-file-input  id="photo4" prepend-icon="none">
                <template v-slot:prepend-inner>
                  <label for="photo4" id="photo">上傳圖檔</label>
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

:deep(.v-field__overlay) {
  background-color: #fff;
}
:deep(.v-card.v-theme--light.v-card--density-default.v-card--variant-elevated) {
  height: 50%;
  top: 50%;
  

}
:deep(.v-icon) {
  display: none;
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

#data{
  padding: 0;
}
.text-h5 {
  color: $primaryBrandBlue;
  @include h5_PC;
  font-weight: 900;

}

.form_item{
  display: flex;
  width: 80%;
  margin: 0 auto 2%;
  gap: 6%;
  div.name{
    width: 20%;
    display: flex;
    span{
      margin-left:auto;
    }
  }
 
}
.imgblock {
  margin: 5% auto 2%;
  :deep(.v-field.v-field--appended) {
    display: flex;
  }
  :deep(.v-field__input){
    font-size:12px ;
    line-height: 5vh;
    padding: 0;
  }
  :deep(.v-input__control) {
    width: 70%;
    height: 5vh;
  }

  label#photo{
      margin-bottom: 0;
      position: absolute;
      padding: 10px;
      width: fit-content;
      top: -5px;
      right: -100px;
      background-color: $primaryBrandBlue;
      border-radius: 50px;
      color: #ffff;
      cursor: pointer;
      font-size:14px;
  }

}

input {
  height: 5vh;
  margin-left: 1vw;
  padding-left:1vw ;
  width: 50%;
  border: 1px solid $primaryBrandBlue;
  border-radius: $br_MB;
  &:focus{
    border:2px solid $primaryBrandBlue ;
  }
}

label {
  margin-bottom: 20px;
  display: flex;
}
textarea {
    margin-left: 1vw;
    border: 1px solid $primaryBrandBlue;
    border-radius: $br_MB;
    width: 70%;
    box-sizing: border-box;
    padding: 1vw;
  }


:deep(.v-field__outline) {
  border: 1px solid $primaryBrandBlue;
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
