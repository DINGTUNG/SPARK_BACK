<script setup>
import { ref } from 'vue'
import { useSparkActivityStore } from '@/stores/activity/spark-activity.js';
const sparkActivityStore = useSparkActivityStore();


const dialogDisplay = ref(false);

function showDialog() {
  dialogDisplay.value = true;
}

function closeDialog() {
  dialogDisplay.value = false;
}

const sparkActivityName = ref('')
const sparkActivityDescription = ref('')
const sparkActivityStartDate = ref('')
const sparkActivityEndDate = ref('')

async function createSparkActivity(sparkActivityName, sparkActivityDescription, sparkActivityStartDate, sparkActivityEndDate) {
  try {

    const newActivity = await sparkActivityStore.createSparkActivityBackend(sparkActivityName, sparkActivityDescription, sparkActivityStartDate, sparkActivityEndDate)
    addNewActivityToActivityPool(newActivity)
    window.alert(`新增成功!`);
  } catch (error) {
    console.error(error);
    window.alert(`http status : ${error.response.data} 編輯失敗!請聯絡管理員!`);
  } finally {
    closeDialog()
  }
}

const addNewActivityToActivityPool = (newActivity) => {
  sparkActivityStore.sparkActivityPool.push(newActivity)
}


</script>

<template>
  <v-row class="row" style="flex: 0 0 0;">
    <v-dialog v-model="dialogDisplay" persistent width="50%">
      <template v-slot:activator="{ props }">
        <v-btn class="btn" v-bind="props" @click="showDialog">
          新增
        </v-btn>
      </template>
      <v-card style="border-radius: 50px;">
        <v-card-title class="text-center title">
          新增星火活動
        </v-card-title>
        <v-card-text>
          <form action="https://tibamef2e.com/chd102/g3/back-end/php/activity/spark-activity/create_spark_activity.php" method="post"
            @submit.prevent="createSparkActivity(sparkActivityName, sparkActivityDescription, sparkActivityStartDate, sparkActivityEndDate)">

            <div class="input_container">
              <div class="input_wrap">
                <label for="spark_activity_name">星火活動名稱</label> <input type="text" name="spark_activity_name"
                  v-model="sparkActivityName">
              </div>

              <div class="input_wrap">
                <label for="spark_activity_description">星火活動描述</label>                 <textarea class="description" name="spark_activity_description" v-model="sparkActivityDescription"
                  id="spark_activity_description"></textarea>
              </div>

              <div class="input_wrap">
                <label for="spark_activity_start_date">開始日期</label>
                <input type="date" name="spark_activity_start_date" v-model="sparkActivityStartDate" class="date">
              </div>

              <div class="input_wrap">
                <label for="spark_activity_end_date">結束日期</label> <input type="date" name="spark_activity_end_date"
                  v-model="sparkActivityEndDate" class="date">
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
:deep(.v-btn) {
  background-color: $primaryBrandBlue;
}

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

      textarea.description {
        padding: 1vh 1vw;
        border: 2px solid $primaryBrandBlue;
        border-radius: 10px;
        width: 25vw;
        height: 30vh;
      }
    }
  }
}

input.date {
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