<script setup>
//【引入】
import { ref } from 'vue'
import { useMilestoneStore } from '@/stores/milestone.js'

//
const milestoneStore = useMilestoneStore();
const dialogDisplay = ref(false);

function showDialog() {
    dialogDisplay.value = true;
}

function closeDialog() {
    dialogDisplay.value = false;
}

const milestoneTitle = ref('')
const milestoneDate = ref('')
const milestoneContent = ref('')
const milestoneImage = ref('')

async function createMilestone(milestoneTitle, milestoneDate, milestoneContent, milestoneImage) {
    try {
        const newMilestone = await milestoneStore.createMilestoneBackend(milestoneTitle, milestoneDate, milestoneContent, milestoneImage)
        addContentToNewMilestone(newMilestone)
        console.log(milestoneStore.milestonePool);
        window.alert(`新增成功!`);
    } catch (error) {
        console.error(error);
        window.alert(`http status : ${error.response.data} 新增失敗!請聯絡管理員!`);
    } finally {
        closeDialog()
    }
}

const addContentToNewMilestone = (newMilestone) => {
  milestoneStore.milestonePool.push(newMilestone)
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
          <span class="main_title">新增里程碑</span>
        </v-card-title>
        <v-card-text>
          <form action="http://localhost/SPARK_BACK/php/results/milestone/create_milestone.php" method="post" @submit.prevent="createMilestone(milestoneTitle, milestoneDate, milestoneContent, milestoneImage)">
            <label for="">
              <div class="input_title">標題</div>
              <input type="text" name="milestone_title" v-model="milestoneTitle">
            </label>
            <label for="">
              <div class="input_title">年度/月份</div>
              <input type="month" name="milestone_date" v-model="milestoneDate">
            </label>
            <label for="">
              <div class="input_title">內文</div>
              <textarea name="milestone_content" id="" cols="70" rows="10" v-model="milestoneContent"></textarea>
            </label>

            <div class="imgblock">
              <span>圖片</span>
              <v-file-input variant="outlined" id="book" prepend-icon="none" name="milestone_image" v-model="milestoneImage">
                <template v-slot:prepend-inner>
                  <label for="book">上傳圖檔</label>
                </template>
              </v-file-input>
            </div>


            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="closeDialog">
                  取消
              </v-btn>
              <v-btn color="blue-darken-1" variant="text" type="submit">
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
