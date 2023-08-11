<script setup>
import { ref } from 'vue'
// const dialog = ref(false);


import { useThanksLetterStore } from '@/stores/member/thanks-letter.js';
const thanksLetterStore = useThanksLetterStore();

const dialogDisplay = ref(false);

function showDialog() {
    dialogDisplay.value = true;
}

function closeDialog() {
    dialogDisplay.value = false;
}

const childrenId = ref('')
const memberId = ref('')
const sponsorOrderId = ref('')
const receiveDate = ref('')
const fileName = ref('')

async function CreateThanksLetter(childrenId, memberId, sponsorOrderId, receiveDate, fileName) {
    try {
        const newThanksLetter = await thanksLetterStore.CreateThanksLetterBackend(childrenId, memberId, sponsorOrderId, receiveDate, fileName)
        addContentTonewThanksLetter(newThanksLetter)
        console.log(thanksLetterStore.thanksLetterPool);
        window.alert(`新增成功!`);
    } catch (error) {
        console.error(error);
        window.alert(`http status : ${error.response.data} 新增失敗!請聯絡管理員!`);
    } finally {
        closeDialog()
    }
}

const addContentTonewThanksLetter = (newThanksLetter) => {
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
                <v-card-title>
                    <span class="main_title">新增後台人員</span>
                </v-card-title>
                <v-card-text>
                    <form action="http://localhost:8888/member/thanks_letter/thanks_letter.php" method="post"
                        @submit.prevent="CreateThanksLetter(childrenId, memberId, sponsorOrderId, receiveDate, fileName)">
                        <label for="">
                            <div class="input_title">兒童編號</div>
                            <input type="text" name="children_id" v-model="childrenId">
                        </label>
                        <label for="">
                            <div class="input_title">會員編號</div>
                            <input type="text" name="member_id" v-model="memberId">
                        </label>
                        <label for="">
                            <div class="input_title">認養訂單ID</div>
                            <input type="text" name="sponsor_order_id" v-model="sponsorOrderId">
                        </label>
                        <label for="">
                            <div class="input_title">收件日期</div>
                            <input type="text" name="receive_date" v-model="receiveDate">
                        </label>
                        <label for="">
                            <div class="input_title">檔名</div>
                            <input type="text" name="file_name" v-model="fileName">
                        </label>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue-darken-1" variant="text" @click="closeDialog">
                                取消
                            </v-btn>
                            <v-btn color="blue-darken-1" variant="text" type="submit">
                                確定
                            </v-btn>
                        </v-card-actions>
                    </form>
                </v-card-text>

            </v-card>
        </v-dialog>
    </v-row>
</template>
<style scoped lang="scss">
:deep(.v-btn.v-btn--density-default) {
    background-color: $primaryBrandBlue !important;

}

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

label {
    @include flex_hm();
}

.main_title {
    display: block;
    color: $primaryBrandBlue;
    @include h1_PC;
    margin: 24px 0;
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

    //用來固定欄位名的寬度，方便對齊
    .input_title {
        width: 4vw;
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

:deep(.v-btn.v-btn--density-default) {
    background-color: $primaryBrandBlue !important;
    width: 137px;
    height: 55px;
    border-radius: 50px;
    margin: 30px 20px 60px 0;
    // margin-bottom: 50px;
    // margin-right: 20px;
    @include h5_PC;
}

:deep(.v-btn__content) {
    font-size: 20px;
}
</style>
