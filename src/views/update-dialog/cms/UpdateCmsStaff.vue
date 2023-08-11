<script setup>
import { ref } from 'vue'
const dialog = ref(false);
</script>

<template>
    <v-row class="row" style="flex: 0;">
        <v-dialog v-model="dialog" persistent width="50%">
            <template v-slot:activator="{ props }">
                <v-icon size="small" class="me-2 icon" v-bind="props">mdi-pencil</v-icon>
            </template>
            <v-card>
                <v-card-title>
                    <span class="main_title">編輯後台人員</span>
                </v-card-title>
                <v-card-text>
                    <form action="">
                        <label for="">
                            <div class="input_title">姓名</div>
                            <input type="text">
                        </label>
                        <label for="">
                            <div class="input_title">Email</div>
                            <input type="text">
                        </label>
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
