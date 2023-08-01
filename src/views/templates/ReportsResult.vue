<script setup>
import { ref, reactive, computed } from 'vue'

const dialog = ref(false);
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
                    <span class="text-h5">新增歷年據點</span>
                </v-card-title>
                <v-card-text>
                    <form action="">
                        <label for="">報告分類
                            <input type="text">
                        </label>
                        <label for="" class="report_title">標題
                            <input type="text">
                        </label>
                        <label for="">封面照片
                            <input type="file">
                        </label>
                        <div>
                            <input type="file" name="" id="file1">
                        </div>
                        <div>
                            <label for="">選擇文件</label>
                        </div>
                    </form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
                        取消
                    </v-btn>
                    <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
                        儲存
                    </v-btn>
                </v-card-actions>
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
}

:deep(.v-btn__content) {
    color: #ffff !important;
}

:deep(.v-card .v-card-title) {
    padding: 20px;
    text-align: center;
}



.text-h5 {
    color: $primaryBrandBlue;
    @include h5_PC;
    font-weight: 900;

}


label {
    margin-bottom: 20px;
    display: flex;
    @include flex_hm();

    input {
        height: 5vh;
        padding-left: 10px;
        padding-top: 5px;
        margin-left: 1vw;
        width: 25vw;
        border: 1px solid;
        border-radius: $br_MB;
    }
}



label.report_title {
    margin-right: -30px;

}

:deep(.v-btn.v-btn--density-default) {
    background-color: $primaryBrandBlue !important;
    width: 137px;
    height: 55px;
    border-radius: 50px;
    margin-bottom: 50px;
    margin-right: 20px;
}

:deep(.v-btn__content) {
    font-size: 20px;
}
</style>