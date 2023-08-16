<script setup>
import { ref, defineProps, reactive } from 'vue';
import axios from 'axios';
const dialog = ref(false);

//獲取外層傳進的 story_no
const props = defineProps(['storyNo']);
const storyFormData = reactive({
  story_title: '',
  story_date: '',
  story_brief: '',
  story_detail: '',
  story_detail_second: '',
  story_detail_third: '',
  story_image: '',
});
// 獲取該 story_no 的資料
const url = `https://tibamef2e.com/chd102/g3/back-end/php/results/story/update_story.php?story_no=${props.storyNo}`;
async function getUpdateNo() {
  try {
    const response = await axios.post(`https://tibamef2e.com/chd102/g3/back-end/php/results/story/update_data_story.php?story_no=${props.storyNo}`)
    const data = response.data;
    if( data )  {
      storyFormData.story_title = data[0].story_title;
      storyFormData.story_date = data[0].story_date;
      storyFormData.story_brief = data[0].story_brief;
      storyFormData.story_image = data[0].story_image;
      storyFormData.story_detail = data[0].story_detail;
      storyFormData.story_detail_second = data[0].story_detail_second;
      storyFormData.story_detail_third = data[0].story_detail_third;
    }
  } catch (error) {
    console.error(error);
  }
}
// 監聽表單提交事件，呼叫 handleSubmit 處理
const storyForm = document.getElementById('storyForm');
if (storyForm) {
  storyForm.addEventListener('submit', handleSubmit);
}
//更新資料
async function handleSubmit(e) {
  e.preventDefault();
  const formData = new FormData(storyForm);
  try {
    const response = await fetch(url, {
      method: 'POST',
      body: formData,
    });
  } catch (error) {
    console.error(error);
    alert('更新失败');
  }
}

//字數提醒
const getStyle = (count, maxCount) => {
      return {
        color: count >= maxCount ? 'red' : 'black',
      };
};
const show = (length) => {
  console.log(length);
}
</script> 

<template>
  <v-row justify="end">
    <v-dialog v-model="dialog" persistent width="50%">
      <template v-slot:activator="{ props }">
        <v-icon size="small" class="me-2 icon" @click="getUpdateNo(props.storyNo)" v-bind="props">mdi-pencil</v-icon>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">編輯消息</span>
        </v-card-title>
        <v-card-text>
          <form id="storyForm" method="POST" :action="url" enctype="multipart/form-data">
            <div class="form_item">
              <div class="name"><span>標題</span></div>
              <input type="text" :value="storyFormData.story_title" id="title" name="story_title">     
            </div>
            <div class="form_item">
              <div class="name"><span>日期</span></div>
              <input type="date" :value="storyFormData.story_date" id="date" name="story_date">
            </div>
            <div class="imgblock form_item">
              <div class="name"><span>圖檔</span></div>
              <v-file-input id="photo1" prepend-icon="none" name="story_image">
                <template v-slot:prepend-inner>
                  <label for="photo1" id="photo">修改圖檔</label>
                </template>
              </v-file-input>
            </div>
            <div class="form_item">
              <div class="name"><span>簡述</span></div>
              <textarea id="brief" @click="show(storyFormData.story_brief.length)" v-model="storyFormData.story_brief" cols="70" rows="10" name="story_brief"></textarea>
              <span class="count" :style="getStyle(storyFormData.story_brief.length, 50)">{{ storyFormData.story_brief.length }}<span> / 50</span></span>
            </div>
            <div class="form_item">
              <div class="name"><span>段落1</span></div>
              <textarea id="paragraph" v-model="storyFormData.story_detail" name="story_detail" cols="70" rows="10"></textarea>
              <span class="count" :style="getStyle(storyFormData.story_detail.length, 90)">{{ storyFormData.story_detail.length }}<span> / 90</span></span>
            </div>
            <div class="form_item">
              <div class="name"><span>段落2</span></div>
              <textarea id="paragraph" v-model="storyFormData.story_detail_second" name="story_detail_second" cols="70" rows="10"></textarea>
              <span class="count" :style="getStyle(storyFormData.story_detail_second.length, 90)">{{ storyFormData.story_detail_second.length }}<span> / 90</span></span>
            </div>
            <div class="form_item">
              <div class="name"><span>段落3</span></div>
              <textarea id="paragraph"  v-model="storyFormData.story_detail_third" name="story_detail_third" cols="70" rows="10"></textarea>
              <span class="count" :style="getStyle(storyFormData.story_detail_third.length, 90)" >{{ storyFormData.story_detail_third.length }} / 90</span>
            </div>
            <v-card-actions>
            <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
                取消
              </v-btn>
              <v-btn type="submit" color="blue-darken-1" variant="text">
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
:deep(.v-row) {
  display: inline-block!important;
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

:deep(.v-input--center-affix .v-input__prepend) {
  display: none;
}

:deep(.imgblock[data-v-bea6dedf] .v-field.v-field--appended) {
  position: relative;
  right: 20px;

}

#data {
  padding: 0;
}

.text-h5 {
  color: $primaryBrandBlue;
  @include h5_PC;
  font-weight: 900;

}

.form_item {
  display: flex;
  width: 80%;
  margin: 0 auto 2%;
  gap: 6%;
  position: relative;

  div.name {
    width: 20%;
    display: flex;

    span {
      margin-left: auto;
    }
  }

}

.imgblock {
  margin: 5% auto 2%;

  :deep(.v-field.v-field--appended) {
    display: flex;
  }

  :deep(.v-field__input) {
    font-size: 12px;
    line-height: 5vh;
    padding: 0;
  }

  :deep(.v-input__control) {
    width: 70%;
    height: 5vh;
  }

  label#photo {
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
    font-size: 14px;
  }

}

input {
  height: 5vh;
  margin-left: 1vw;
  padding-left: 1vw;
  width: 50%;
  border: 1px solid $primaryBrandBlue;
  border-radius: $br_MB;

  &:focus {
    border: 2px solid $primaryBrandBlue ;
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
