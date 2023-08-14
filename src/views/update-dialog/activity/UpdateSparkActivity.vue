<script setup>
import { ref, defineProps } from 'vue'
import { useSparkActivityStore } from '@/stores/activity/spark-activity.js';
const sparkActivityStore = useSparkActivityStore();

const vueProps = defineProps({
  sparkActivityNoForUpdate: Number,
  sparkActivityNameForUpdate: String,
  sparkActivityDescriptionForUpdate: String,
  sparkActivityStartDateForUpdate: String,
  sparkActivityEndDateForUpdate: String
})

const sparkActivityName = ref('')
const sparkActivityDescription = ref('')
const sparkActivityStartDate = ref('')
const sparkActivityEndDate = ref('')

const dialogDisplay = ref(false);

function showDialog() {
  dialogDisplay.value = true;
  sparkActivityName.value = vueProps.sparkActivityNameForUpdate
  sparkActivityDescription.value = vueProps.sparkActivityDescriptionForUpdate
  sparkActivityStartDate.value = vueProps.sparkActivityStartDateForUpdate
  sparkActivityEndDate.value = vueProps.sparkActivityEndDateForUpdate
}

function closeDialog() {
  dialogDisplay.value = false;
}


async function updateSparkActivity(sparkActivityNoForUpdate, sparkActivityName, sparkActivityDescription, sparkActivityStartDate, sparkActivityEndDate) {
  try {
    if (sparkActivityNoForUpdate == null) {
      throw new Error("spark activity no. not found!")
    }
    await sparkActivityStore.updateSparkActivityBackend(sparkActivityNoForUpdate, sparkActivityName, sparkActivityDescription, sparkActivityStartDate, sparkActivityEndDate)
    sparkActivityStore.updateSparkActivityFromSparkActivityPool(sparkActivityNoForUpdate, sparkActivityName, sparkActivityDescription, sparkActivityStartDate, sparkActivityEndDate)
    window.alert(`編輯成功!`);
  } catch (error) {
    console.error(error);
    window.alert(`http status : ${error.response.data} 編輯失敗!請聯絡管理員!`);
  } finally {
    closeDialog()
  }
}

</script>

<template>
  <v-row class="row" style="flex: 0 0 0;">
    <v-dialog v-model="dialogDisplay" persistent width="50%">
      <template v-slot:activator="{ props }">
        <v-icon size="small" class="me-2 icon" v-bind="props" @click="showDialog">mdi-pencil</v-icon>
      </template>
      <v-card style="border-radius: 50px;">
        <v-card-title class="text-center title">
          編輯星火活動
        </v-card-title>
        <v-card-text>
          <form action="http://localhost/SPARK_BACK/php/activity/message-board/update_message.php" method="post"
            @submit.prevent="updateSparkActivity(vueProps.sparkActivityNoForUpdate, sparkActivityName, sparkActivityDescription, sparkActivityStartDate, sparkActivityEndDate)">

            <div class="input_container">
              <div class="input_wrap">
                <label for="spark_activity_name">星火活動名稱</label> <input type="text" name="spark_activity_name"
                  v-model="sparkActivityName">
              </div>

              <div class="input_wrap">
                <label for="spark_activity_description">星火活動描述</label>
                <textarea class="description" name="spark_activity_description" v-model="sparkActivityDescription"
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