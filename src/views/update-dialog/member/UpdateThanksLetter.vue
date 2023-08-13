<script setup>
import { ref, defineProps } from 'vue'
import { useThanksLetterStore } from '@/stores/member/thanks-letter.js';
const thanksLetterStore = useThanksLetterStore();

const vueProps = defineProps({
    thanksLetterNoForUpdate: Number,
    childrenIdForUpdate: String,
    memberIdForUpdate: String,
    sponsorOrderIdForUpdate: String,
    receiveDateForUpdate: String,
    fileNameForUpdate: String,
})


const childrenId = ref('')
const memberId = ref('')
const sponsorOrderId = ref('')
const receiveDate = ref('')

const dialogDisplay = ref(false);

function closeDialog() {
  dialogDisplay.value = false;
}

function showDialog() {
    dialogDisplay.value = true;
    childrenId.value = vueProps.childrenIdForUpdate
    memberId.value = vueProps.memberIdForUpdate
    sponsorOrderId.value = vueProps.sponsorOrderIdForUpdate
    receiveDate.value = vueProps.receiveDateForUpdate
    fileNameForUpdate.fileName['name'] = vueProps.newsImageFirstForUpdate
}



async function updateThanksLetter
(thanksLetterNoForUpdate,
childrenId, memberId, sponsorOrderId, receiveDate ) {
  try {
    if (thanksLetterNoForUpdate == null) {
      throw new Error("thanks letter no. not found!")
    }
    await thanksLetterStore.updateThanksLetterBackend(thanksLetterNoForUpdate, childrenId, memberId, sponsorOrderId, receiveDate )
    thanksLetterStore.updateThanksLetterFromThanksLetterPool(thanksLetterNoForUpdate, childrenId, memberId, sponsorOrderId, receiveDate )
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
          <form action="http://localhost:8888/member/thanks-letter/update_letter.php" method="post"
            @submit.prevent="updateThanksLetter(vueProps.thanksLetterNoForUpdate, childrenId, memberId, sponsorOrderId, receiveDate )">

            <div class="input_container">
              <div class="input_wrap">
                <label for="children_id">兒童ID</label> <input type="text" name="children_id"
                  v-model="childrenId">
              </div>

              <div class="input_wrap">
                <label for="member_id">會員ID</label> <input type="text"
                  name="member_id" v-model="memberId">
              </div>

              <div class="input_wrap">
                <label for="sponsor_order_id">認養訂單ID</label>
                <input type="date" name="sponsor_order_id" v-model="sponsorOrderId">
              </div>

              <div class="input_wrap">
                <label for="receive_date">收件日期</label> <input type="date" name="receive_date"
                  v-model="receiveDate" class="date">
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
