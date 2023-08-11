<script setup>
import { ref, reactive, defineProps } from 'vue'
import { useNewsStore } from '@/stores/news/news.js';
const newsStore = useNewsStore();

const vueProps = defineProps({
  newsNoForUpdate: Number,
  newsDateForUpdate: String,
  newsImageFirstForUpdate: String,
  newsImageSecondForUpdate: String
})

const newsForUpdate = reactive({
  newsNo: null,
  newsDate: null,
  newsImageFirst: null,
  newsImageSecond: null
})

const dialogDisplay = ref(false);

function showDialog() {
  dialogDisplay.value = true;
  newsForUpdate.newsNo = vueProps.newsNoForUpdate
  newsForUpdate.newsDate = vueProps.newsDateForUpdate
  newsForUpdate.newsImageFirst = vueProps.newsImageFirstForUpdate
  console.log("狸貓", newsForUpdate.newsImageFirst);

  newsForUpdate.newsImageSecond = vueProps.newsImageSecondForUpdate
}

function closeDialog() {
  dialogDisplay.value = false;
}

async function updateNews(newsNoForUpdate) {
  try {
    if (newsNoForUpdate == null) {
      throw new Error("news no. not found!")
    }
    const response = await newsStore.updateNewsBackend(newsForUpdate)
    window.alert(response)
    newsStore.updateNewsFromNewsPool(newsForUpdate)
    window.alert(`編輯成功!`);
  } catch (error) {
    console.error(error);
    window.alert(`http status : ${error.response.data} 編輯失敗!請聯絡管理員!`);
  } finally {
    closeDialog()
  }
}
</script>

<template>
  <v-row justify="end">
    <v-dialog v-model="dialogDisplay" persistent width="50%">
      <template v-slot:activator="{ props }">
        <v-icon size="small" class="me-2 icon" v-bind="props" @click="showDialog">mdi-pencil</v-icon>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">編輯消息</span>
        </v-card-title>
        <v-card-text>
          <form action="http://localhost/SPARK_BACK/php/activity/message-board/update_message.php" method="post"
            @submit.prevent="updateNews(vueProps.newsNoForUpdate)">
            <div class="form_item">
              <div class="name"><span>標題</span></div>
              <input type="text" id="title">
            </div>
            <div class="form_item">
              <div class="name"><span>日期</span></div>
              <input type="date" id="date" v-model="newsForUpdate.newsDate" name="news_date">
            </div>
            <div class="form_item">
              <div class="name"><span>段落1</span></div>
              <textarea id="paragraph1" cols="70" rows="10"></textarea>
            </div>

            <div class="imgblock form_item">
              <div class="name"><span>圖檔1</span></div>
              <v-file-input id="photo1" prepend-icon="none" accept="image/*" label="請上傳圖檔"
                v-model="newsForUpdate.newsImageFirst" name="news_image_first">
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
              <v-file-input id="photo2" prepend-icon="none" accept="image/*" label="請上傳圖檔"
                v-model="newsForUpdate.newsImageSecond">
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
              <v-file-input id="photo3" prepend-icon="none" accept="image/*" label="請上傳圖檔">
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
              <v-file-input id="photo4" prepend-icon="none" accept="image/*" label="請上傳圖檔">
                <template v-slot:prepend-inner>
                  <label for="photo4" id="photo">上傳圖檔</label>
                </template>
              </v-file-input>
            </div>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="closeDialog">
                取消
              </v-btn>
              <v-btn color="blue-darken-1" variant="text" type="submit">
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
