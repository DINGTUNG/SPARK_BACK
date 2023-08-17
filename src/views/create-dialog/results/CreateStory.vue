<script setup>
import { ref, watch} from 'vue'
import axios from 'axios';
const dialog = ref(false);

const story_brief = ref('');
const story_detail = ref('');
const story_detail_second = ref('');
const story_detail_third = ref('');
const getStyle = (count, maxCount) => {
      return {
        color: count >= maxCount ? 'red' : 'black',
      };
};

const handleSubmit = async (event) => {
  event.preventDefault();
  try {
    const storyForm = document.getElementById('storyForm')
    const formData = new FormData(storyForm);
    const response = await axios.post('https://tibamef2e.com/chd102/g3/back-end/php/results/story/add_story.php', formData)
    if (response.data.ok) {
      alert('新增成功');
      window.location.reload();
    } else {
      alert('新增失敗');
    }
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
          <span class="text-h5">新增故事</span>
        </v-card-title>
        <v-card-text>
          <form id="storyForm" method="POST" action="https://tibamef2e.com/chd102/g3/back-end/php/results/story/add_story.php">
            <div class="form_item">
              <label for=""><span>標題</span></label>
              <input type="text" name="story_title" required>
            </div>
            <div class="form_item">
              <label for=""><span>日期</span></label>
              <input type="date" name="story_date" required>
            </div>
            <div class="imgblock form_item">
              <div class="name"><span>圖檔1</span></div>
              <v-file-input name="story_image" id="photo1" prepend-icon="none">
                <template v-slot:prepend-inner>
                  <label for="photo1" id="photo">上傳圖檔</label>
                </template>
              </v-file-input>
            </div>
            <div class="form_item">
              <label for="">簡述</label>
              <textarea name="story_brief" v-model="story_brief" placeholder="50字左右可以獲得最佳顯示效果喔~" cols="30" rows="10" required></textarea>
              <span class="count" :style="getStyle(story_brief.length, 50)">{{ story_brief.length }}<span> / 50</span></span>
            </div>
            <div class="form_item">
              <label for="">段落1</label>
              <textarea name="story_detail" v-model="story_detail"  placeholder="每段不要超過90字，網頁上看才不會太擠喔~" cols="70" rows="10" required></textarea>
              <span class="count" :style="getStyle(story_detail.length, 90)">{{ story_detail.length }}<span> / 90</span></span>
            </div>
            <div class="form_item">
              <label for="">段落2</label>
              <textarea name="story_detail_second" v-model="story_detail_second" placeholder="每段不要超過90字，網頁上看才不會太擠喔~" cols="70" rows="10" required></textarea>
              <span class="count" :style="getStyle(story_detail_second.length, 90)">{{ story_detail_second.length }}<span> / 90</span></span>
            </div>
            <div class="form_item">
              <label for="">段落3</label>
              <textarea name="story_detail_third" v-model="story_detail_third" placeholder="每段不要超過90字，網頁上看才不會太擠喔~" cols="70" rows="10" required></textarea>
              <span class="count" :style="getStyle(story_detail_third.length, 90)" >{{ story_detail_third.length }} / 90</span>
            </div>
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
.count {
  position: absolute;
  bottom: 0;
  right: -60px;
  span{
    color: black;
  }
}
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
  position: relative;
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

label:not(#photo) {
  width: 20%;
  display:inline-block;
  text-align: right;
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
