<script setup>
import { ref, reactive } from 'vue'
import { useThanksLetterStore } from '@/stores/member/thanks-letter.js';

const thanksLetterStore = useThanksLetterStore();
const dialogDisplay = ref(false);

function showDialog() {
    dialogDisplay.value = true;
}
function closeDialog() {
    dialogDisplay.value = false;
}
const thanksLetterForCreate = reactive({
    thanksLetterNo: null,
    childrenId: "",
    memberId: "",
    sponsorOrderId: "",
    receiveDate: "",
    thanksLetterFile: [],
})

async function CreateThanksLetter(thanksLetterForCreate) {
    try {
        const newThanksLetter = await thanksLetterStore.CreateThanksLetterBackend(thanksLetterForCreate)
        addContentToNewThanksLetter(newThanksLetter)
 
        window.alert(`新增成功!`);
    } catch (error) {
        console.error(error);
        window.alert(`新增失敗!請聯絡管理員!`);
    } finally {
        closeDialog()
    }
}

const addContentToNewThanksLetter = (newThanksLetter) => {
    thanksLetterStore.thanksLetterPool.push(newThanksLetter)
}
</script>

<template>
    <v-row justify="end">
        <v-dialog v-model="dialogDisplay" persistent width="50%">
            <template v-slot:activator="{ props }">
                <v-btn color="primary" v-bind="props" @click="showDialog">
                    新增
                </v-btn>
            </template>
            <v-card>
              <form action="http://localhost/SPARK-BACK/php/member/thanks-letter/create_letter.php" method="post" @submit.prevent="
                CreateThanksLetter(thanksLetterForCreate)">
                <!-- <form action="http://localhost:8888/member/thanks-letter/create_letter.php" method="post" @submit.prevent="
                CreateThanksLetter(thanksLetterForUpdate)"> -->
                    <v-card-title>
                        <span class="main_title">新增感謝函</span>
                    </v-card-title>
                    <v-card-text>
                        <label for="">
                            <div class="input_title">兒童ID</div>
                            <input type="text" name="children_id" v-model="thanksLetterForCreate.childrenId">
                        </label>
                        <label for="">
                            <div class="input_title">會員ID</div>
                            <input type="text" name="member_id" v-model="thanksLetterForCreate.memberId">
                        </label>
                        <label for="">
                            <div class="input_title">認養訂單ID</div>
                            <input type="text" name="sponsor_order_id" v-model="thanksLetterForCreate.sponsorOrderId">
                        </label>
                        <label for="date" class="custom-label">
                            <div class="input_title">收件日期</div>
                            <input type="date" id="date" name="receive_date" v-model="thanksLetterForCreate.receiveDate">
                        </label>
                        <div class="imgblock form_item">
                            <span>圖片</span>
                            <v-file-input variant="outlined" id="photo1" prepend-icon="none" name="thanks_letter_file" v-model="thanksLetterForCreate.thanksLetterFile" >
                                <template v-slot:prepend-inner>
                                    <label for="photo1" id="photo">上傳圖檔</label>
                                </template>
                            </v-file-input>
                        </div>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn class="cancel btn" variant="text" @click="closeDialog">
                                取消
                            </v-btn>
                            <v-btn class="update btn" variant="text" type="submit">
                                確定
                            </v-btn>
                        </v-card-actions>                    
                    </v-card-text>
                </form>
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
  border-radius: 60px;
  overflow: hidden;
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

:deep(.imgblock[data-v-bea6dedf] .v-field.v-field--appended) {
  position: relative;
  right: 20px;
}

.main_title {
    display: block;
    color: $primaryBrandBlue;
    @include h1_PC;
    margin: 24px 0;
}

.imgblock {
  display: flex;

  span {
    // @include flex_vm();
    // justify-content: start;
    width: 10vw;
    text-align: right;
    @include h4_PC;
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
    margin-left: -21px;
  }

  label {
    @include flex_vm();
    margin-bottom: 0;
    position: relative;
    left: 19vw;
    padding: 10px;
    background-color: $primaryBrandBlue;
    border-radius: 50px;
    width: 6vw;
    color: #ffff;
    @include h5_PC;
  }

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

    //用來固定欄位名的寬度，方便對齊
    .input_title {
        width: 10vw;
        text-align: right;
        @include h4_PC;
    }

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
  margin: 30px 20px 60px 0;
  // margin-bottom: 50px;
  // margin-right: 20px;
  @include h5_PC;
}
</style>
