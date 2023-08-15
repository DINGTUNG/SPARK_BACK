<script setup>
import { ref, reactive, defineProps } from 'vue'
import { useDonateStore } from '@/stores/donate/donate-project.js';
const DonateStore = useDonateStore();

const vueProps = defineProps({
    donateNoForUpdate: Number,
    donateNameForUpdate: String,
    donateStartDateForUpdate: String,
    donateEndDateForUpdate: String,
    donateSummarizeForUpdate: String,
    donateImageForUpdate: String,
})

const donateForUpdate = reactive({
    donateNo: null,
    donateName: "",
    donateStartDate: null,
    donateEndDate: null,
    donateSummarize: "",
    donateImage: [],
})

// const donateName = ref('')
// const donateStartDate = ref('')
// const donateEndDate = ref('')
// const donateSummarize = ref('')
// const donateImage = ref('')

const dialogDisplay = ref(false);

function closeDialog() {
    dialogDisplay.value = false;
}

function showDialog() {
    dialogDisplay.value = true;
    donateForUpdate.donateNo = vueProps.donateNoForUpdate
    donateForUpdate.donateName = vueProps.donateNameForUpdate
    donateForUpdate.donateStartDate = vueProps.donateStartDateForUpdate
    donateForUpdate.donateEndDate = vueProps.donateEndDateForUpdate
    donateForUpdate.donateSummarize = vueProps.donateSummarizeForUpdate
    donateForUpdate.donateImage['name'] = vueProps.donateImageForUpdate
}

async function updateDonate() {

    try {
        if (donateForUpdate.donateNo == null) {
            throw new Error("donate project no. not found!")
        }
        await DonateStore.updateDonateBackend(donateForUpdate)
        DonateStore.updateDonateFromDonatePool(donateForUpdate)
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
    <v-row class="row" style="flex: 0;">
        <v-dialog v-model="dialogDisplay" persistent width="50%">
            <template v-slot:activator="{ props }">
                <v-icon size="small" class="me-2 icon" v-bind="props" @click="showDialog">mdi-pencil</v-icon>
            </template>
            <v-card>
                <v-card-title>
                    <span class="main_title">編輯捐款專案</span>
                </v-card-title>
                <v-card-text>
                    <form action="http://localhost/SPARK_BACK/php/donate/donate-project/update_donate_project.php"
                        method="post" @submit.prevent="updateDonate">
                        <label for="">
                            <div class="input_title">標題</div>
                            <input type="text" name="donate_project_name" v-model="donateForUpdate.donateName">
                        </label>
                        <label for="">
                            <div class="input_title">開始日期</div>
                            <input type="date" name="donate_project_start_date" v-model="donateForUpdate.donateStartDate">
                        </label>
                        <label for="">
                            <div class="input_title">結束日期</div>
                            <input type="date" name="donate_project_end_date" v-model="donateForUpdate.donateEndDate">
                        </label>
                        <label for="">
                            <div class="input_title">內文</div>
                            <textarea name="donate_project_summarize" cols="70" rows="10"
                                v-model="donateForUpdate.donateSummarize"></textarea>
                        </label>

                        <div class="imgblock">
                            <span>封面照片</span>
                            <v-file-input variant="outlined" id="coverPic" prepend-icon="none" accept="image/*"
                                label="請上傳圖檔" v-model="donateForUpdate.donateImage">
                                <template v-slot:prepend-inner>
                                    <label for="coverPic">上傳圖檔</label>
                                </template>
                            </v-file-input>
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