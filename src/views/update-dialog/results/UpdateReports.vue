<script setup>
import { ref, defineProps, reactive } from 'vue'
const vueProps = defineProps({
    reportsNoForUpdate: Number,
    reportsClassForUpdate: String,
    reportsYearForUpdate: Number,
    reportsTitleForUpdate: String,
    reportsFileThirdForUpdate: String,
});
const reportsForUpdate = reactive({
    reportsNo: null,
    reportsClass: '',
    reportsYear: '',
    reportsTitle: '',
    reportsFile: []
})

const dialogDisplay = ref(false);

function closeDialog() {
    dialogDisplay.value = false;

}
function showDialog() {
    dialogDisplay.value = true;
    reportsForUpdate.reportsNo = vueProps.reportsNoForUpdate
    reportsForUpdate.reportsClass = vueProps.reportsClassForUpdate
    reportsForUpdate.reportsYear = vueProps.reportsYearForUpdate
    reportsForUpdate.reportsTitle = vueProps.reportsTitleForUpdate
    reportsForUpdate.reportsFile['name'] = vueProps.reportsFileThirdForUpdate
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
                    <span class="text-h5">修改報告</span>
                </v-card-title>
                <v-card-text>
                    <form id="reportFrom" method="POST"
                        action="http://localhost/SPARK_BACK/php/results/reports/add_reports.php"
                        enctype="multipart/form-data">
                        <div class="form_item">
                            <div class="name"><span>報告分類</span></div>
                            <input type="text" id="title" name="report_class" v-model="reportsForUpdate.reportsClass">
                        </div>
                        <div class="form_item">
                            <div class="name"><span>年度</span></div>
                            <input type="text" id="date" name="report_year" v-model="reportsForUpdate.reportsYear">
                        </div>
                        <div class="form_item">
                            <div class="name"><span>標題</span></div>
                            <input type="text" id="date" name="report_title" v-model="reportsForUpdate.reportsTitle">
                        </div>
                        <div class="imgblock form_item">
                            <div class="name"><span>報告</span></div>
                            <v-file-input id="photo1" prepend-icon="none" name="report_file"
                                v-model="reportsForUpdate.reportsFile">
                                <template v-slot:prepend-inner>
                                    <label for="photo1" id="photo">修改報告</label>
                                </template>
                            </v-file-input>
                        </div>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue-darken-1" variant="text" @click="closeDialog">
                                取消
                            </v-btn>
                            <v-btn color="blue-darken-1" variant="text" type="submit" @click="closeDialog">
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

:deep(.v-input--center-affix .v-input__prepend) {
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
    margin-right: 50px;

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
