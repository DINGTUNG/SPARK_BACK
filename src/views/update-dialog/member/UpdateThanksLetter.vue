<script setup>
import { ref,reactive, defineProps } from 'vue'
import { useThanksLetterStore } from '@/stores/member/thanks-letter.js';
const thanksLetterStore = useThanksLetterStore();

const vueProps = defineProps({
    thanksLetterNoForUpdate: Number,
    childrenIdForUpdate: String,
    memberIdForUpdate: String,
    sponsorOrderIdForUpdate: String,
    receiveDateForUpdate: String,
    thanksLetterFileForUpdate: String,
})

const thanksLetterForUpdate = reactive({
    thanksLetterNo: null,
    childrenId: "",
    memberId: "",
    sponsorOrderId: "",
    receiveDate: "",
    thanksLetterFile: [],
})

const dialogDisplay = ref(false);

function closeDialog() {
  dialogDisplay.value = false;
}

function showDialog() {
    dialogDisplay.value = true;
    thanksLetterForUpdate.thanksLetterNo = vueProps.thanksLetterNoForUpdate
    thanksLetterForUpdate.childrenId = vueProps.childrenIdForUpdate
    thanksLetterForUpdate.memberId = vueProps.memberIdForUpdate
    thanksLetterForUpdate.sponsorOrderId = vueProps.sponsorOrderIdForUpdate
    thanksLetterForUpdate.receiveDate = vueProps.receiveDateForUpdate
    thanksLetterForUpdate.thanksLetterFile['name'] = vueProps.thanksLetterFileForUpdate
}


async function updateThanksLetter
(thanksLetterNoForUpdate) {
  try {
    if (thanksLetterNoForUpdate == null) {
      throw new Error("thanks letter no. not found!")
    }
    await thanksLetterStore.updateThanksLetterBackend(thanksLetterForUpdate)
    thanksLetterStore.updateThanksLetterFromThanksLetterPool(thanksLetterForUpdate)
    window.alert(`編輯成功!`);
  } catch (error) {
    console.error(error);
    window.alert(`http status : ${error.response} 編輯失敗!請聯絡管理員!`);
  } finally {
    closeDialog()
  }
}
</script>

<template>
 <v-row class="row" style="flex: 0 0 0;">
    <v-dialog v-model="dialogDisplay" persistent width="50%">
      <template v-slot:activator="{ props }">
        <v-icon size="small" class="me-2 icon" v-bind="props" @click="showDialog">mdi-pencil</v-icon>
      </template>
      <v-card style="border-radius: 50px;">
        <v-card-title class="text-center title">
          編輯感謝函
        </v-card-title>
        <v-card-text>
          <!-- <form action="http://localhost:8888/member/thanks-letter/update_letter.php" method="post"
            @submit.prevent="updateThanksLetter(vueProps.thanksLetterNoForUpdate)"> -->
            <form action="http://localhost/SPARK_BACK/php/member/thanks-letter/update_letter.php" method="post"
            @submit.prevent="updateThanksLetter(vueProps.thanksLetterNoForUpdate)">

            <div class="input_container">
              <div class="input_wrap">
                <label for="children_id">兒童ID</label> <input type="text" name="children_id"
                  v-model="thanksLetterForUpdate.childrenId">
              </div>

              <div class="input_wrap">
                <label for="member_id">會員ID</label> <input type="text"
                  name="member_id" v-model="thanksLetterForUpdate.memberId">
              </div>

              <div class="input_wrap">
                <label for="sponsor_order_id">認養訂單ID</label>
                <input type="text" name="sponsor_order_id" v-model="thanksLetterForUpdate.sponsorOrderId">
              </div>

              <div class="input_wrap">
                <label for="receive_date">收件日期</label> <input type="date" name="receive_date"
                  v-model="thanksLetterForUpdate.receiveDate" class="date">
              </div>

              <div class="imgblock form_item">
                <div class="name">
                  <span>感謝函圖檔</span>
                </div>
                <v-file-input id="photo1" prepend-icon="none" accept="image/*" label="請上傳感謝函圖檔"
                  v-model="thanksLetterForUpdate.thanksLetterFile" name="thanks_letter_file">
                  <template v-slot:prepend-inner>
                    <label for="photo1" id="photo">上傳圖檔</label>
                  </template>
                </v-file-input>
              </div>
            </div>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn class="cancel btn" variant="text" @click="closeDialog">
                取消
              </v-btn>
              <v-btn class="update btn" variant="text" type="submit">
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
:deep(.v-card .v-card-title) {
  color: $primaryBrandBlue;
  font-size: 2vw;
  font-weight: bold;
  text-align: center;
  margin: 8vh 0 0;
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

form {
  margin: auto;

  div.input_container {
    margin: 5vh 0;
    @include flex_vm;
    gap: 3vh;

    div.input_wrap {
      @include flex_hm;

      label {
        width: 10vw;
        font-size: 1.2vw;
        font-weight: bold;
      }

      input {
        padding: 0 1vw;
        width: 25vw;
        height: 6vh;
        border: 2px solid $primaryBrandBlue;
        border-radius: 10px;
      }
    }
  }
}

input.date{
  cursor: pointer;
  
}

::-webkit-calendar-picker-indicator {
  cursor: pointer;
}

:deep(.icon) {
  @include btnEffect;
}

:deep(.btn) {
  width: 8vw;
  height: 6vh;
  border-radius: 50px;
  margin: 3vh 1vw;
}

:deep(.cancel) {
  background-color: white;
  border: 2px solid $primaryBrandBlue;

  .v-btn__content {
    color: $primaryBrandBlue;
  }
}

:deep(.update) {
  background-color: $primaryBrandBlue;

  .v-btn__content {
    color: white;
  }
}

:deep(.v-btn__content) {
  font-size: 1vw;
}
</style>
