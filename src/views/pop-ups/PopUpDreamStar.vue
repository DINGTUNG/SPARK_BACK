<script setup>
import { ref, reactive, computed } from 'vue'
const dialog = ref(false);


// const fileName = ref("");

// function onFileChange(event) {
//   // 更新檔案名稱
//   fileName.value = event.target.files[0]?.name || "";
// }
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
                <div class="scrollbar_wrap">
                    <v-card-title>
                        <span class="main_title">新增星火計畫</span>
                    </v-card-title>
                    <v-card-text>
                        <form action="">
                            <label for="">
                                <div class="input_title">計畫名稱</div>
                                <input type="text">
                            </label>
                            <!-- <label for="">日期
                            <input type="date">
                        </label> -->
                            <label for="">
                                <div class="input_title">夢想內容</div>
                                <textarea name="" id="" cols="70" rows="10"></textarea>
                            </label>
                            <label for="">
                                <div class="input_title">夢想規劃-短期</div>
                                <textarea name="" id="" cols="70" rows="6"></textarea>
                            </label>
                            <label for="">
                                <div class="input_title">夢想規劃-中期</div>
                                <textarea name="" id="" cols="70" rows="6"></textarea>
                            </label>
                            <label for="">
                                <div class="input_title">夢想規劃-長期</div>
                                <textarea name="" id="" cols="70" rows="6"></textarea>
                            </label>
                            <div class="imgblock">
                                <span>照片1(封面)</span>
                                <v-file-input variant="outlined" id="book" prepend-icon="none">
                                    <template v-slot:prepend-inner>
                                        <label for="book">上傳圖檔</label>
                                    </template>
                                </v-file-input>
                            </div>

                            <div class="imgblock">
                                <span>照片2</span>
                                <v-file-input variant="outlined" id="book" prepend-icon="none">
                                    <template v-slot:prepend-inner>
                                        <label for="book">上傳圖檔</label>
                                    </template>
                                </v-file-input>
                            </div>

                            <div class="imgblock">
                                <span>照片3</span>
                                <v-file-input variant="outlined" id="book" prepend-icon="none">
                                    <template v-slot:prepend-inner>
                                        <label for="book">上傳圖檔</label>
                                    </template>
                                </v-file-input>
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
                </div>
            </v-card>

        </v-dialog>
    </v-row>
</template>
<style scoped lang="scss">
:deep(.v-dialog > .v-overlay__content) {
    width: 50%;
}

//彈窗圓角做在這層 div，跟下面 scrollbar 的 overflow 分開
:deep(.v-card.v-theme--light.v-card--density-default.v-card--variant-elevated) {
    height: 50%;
    top: 50%;
    border-radius: 60px;
    overflow: hidden;
}

//新增這層div，用來顯示垂直scrollbar
.scrollbar_wrap {
    overflow-y: scroll;
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
    // align-items: center;


    span {
        // @include flex_vm();
        // justify-content: start;
        width: 12vw;
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
        width: 12vw;
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
