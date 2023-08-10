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
                    <span class="text-h5">新增報告</span>
                </v-card-title>
                <v-card-text>
                    <form action="">
                        <label for="">報告分類
                            <input type="text">
                        </label>
                        <label for="" class="report_title">年度
                            <input type="text">
                        </label>
                        <label for="" class="report_title">標題
                            <input type="text">
                        </label>
                        <div class="pdfblock form_item">
                            <div class="name"><span>報告檔案</span></div>
                            <v-file-input id="photo4" prepend-icon="none">
                                <template v-slot:prepend-inner>
                                    <label for="photo4" id="photo">上傳報告</label>
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

:deep(.v-field__overlay) {
  background-color: #fff;
}

:deep(.v-card.v-theme--light.v-card--density-default.v-card--variant-elevated) {
    height: 50%;
    top: 50%;
}

:deep(.v-input--center-affix .v-input__prepend){
  display: none;
}

:deep(.v-btn__content) {
    color: #ffff !important;
}

:deep(.v-card .v-card-title) {
    padding: 20px;
    text-align: center;
}


:deep(.pdfblock[data-v-bea6dedf] .v-field.v-field--appended) {
    position: relative;
    right: 20px;
}

#data{
  padding: 0;
}

.form_item{
  display: flex;
  width: 80%;
  margin: 0 auto 2%;
  gap: 6%;
  div.name{
    width: 20%;
    display: flex;
    span{
      margin-left:auto;
    }
  }
 
}

.pdfblock {
  margin: 5% auto 2%;
  :deep(.v-field.v-field--appended) {
    display: flex;
  }
  :deep(.v-field__input){
    font-size:12px ;
    line-height: 5vh;
    padding: 0;
  }
  :deep(.v-input__control) {
    width: 70%;
    height: 5vh;
  }

  label#photo{
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
      font-size:14px;
  }

}
input {
  height: 5vh;
  margin-left: 1vw;
  padding-left:1vw ;
  width: 50%;
  border: 1px solid $primaryBrandBlue;
  border-radius: $br_MB;
  &:focus{
    border:2px solid $primaryBrandBlue ;
  }
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
