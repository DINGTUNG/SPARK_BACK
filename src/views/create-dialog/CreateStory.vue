<script setup>
import { ref, defineEmits} from 'vue'
const dialog = ref(false);

const handleSubmit = async (event) => {
  event.preventDefault();
  try {
    const response = await fetch('http://localhost/SPARK_BACK/php/results/story/add_story.php', {
      method: 'POST',
      body: formData.value,
    })
    const storyForm = document.getElementById('storyForm')
    const formData = new FormData(storyForm);
  } catch (error) {
    console.error(error);
    alert('新增失敗');
  }
};

// 監聽表單提交事件，呼叫 handleSubmit 處理
const storyForm = document.getElementById('storyForm');
if (storyForm) {
  storyForm.addEventListener('submit', handleSubmit);
    
}

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
          <form id="storyForm" method="POST" action="http://localhost/SPARK_BACK/php/results/story/add_story.php" enctype="multipart/form-data">
            <label for="">標題
              <input type="text" name="story_title" required>
            </label>
            <label for="">日期
              <input name="story_date" type="date" required>
            </label>
            <div class="imgblock">
              <span>圖檔</span>
              <input type="file" name="story_image" id="upImg">
              <label for="upImg">上傳圖檔</label>
            </div>
            <label for="">簡述
              <textarea name="story_brief" cols="30" rows="10" required></textarea>
            </label>
            <label for="">段落1
              <textarea name="story_detail" cols="70" rows="10" required></textarea>
            </label>
            <label for="">段落2
              <textarea name="story_detail_second" cols="70" rows="10"></textarea>
            </label>
            <label for="">段落3
              <textarea name="story_detail_third" cols="70" rows="10"></textarea>
            </label>
            <v-card-actions>
          <v-spacer></v-spacer>
            <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
              取消
            </v-btn>
            <v-btn type="submit" color="blue-darken-1" variant="text" @click="dialog = false">
              儲存
            </v-btn>
        </v-card-actions>
          </form>
        </v-card-text>

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
:deep(.v-input--center-affix .v-input__prepend){
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

:deep(.imgblock[data-v-52299880] .v-field.v-field--appended) {
  margin-left: 1vw;
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
