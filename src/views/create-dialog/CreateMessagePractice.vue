<script setup>
import { ref } from 'vue'
import { useMessageBoardStore } from '@/stores/message-board.js';
const messageBoardStore = useMessageBoardStore();

const vueProps = defineProps({
  messageNoForUpdate: Number
})

const dialogDisplay = ref(false);

function showDialog() {
  dialogDisplay.value = true;
}

function closeDialog() {
  dialogDisplay.value = false;
}

async function createMessage() {
  try {
    if (messageNoForUpdate == null) {
      throw new Error("Message no. not found!")
    }
    await messageBoardStore.updateMessageBackend(messageNoForUpdate, messageContent)
    messageBoardStore.updateMessageFromMessagePool(messageNoForUpdate)
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
  <v-row justify="end">
    <v-dialog v-model="dialogDisplay" persistent width="50%">
      <template v-slot:activator="{ props }">
        <v-btn color="primary" v-bind="props" @click="showDialog">
          新增
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">新增留言資料</span>
        </v-card-title>
        <v-card-text>
          <form action="http://localhost/SPARK_BACK/php/activity/message-board/update_message.php" method="post"
            @submit.prevent="updateMessage(vueProps.messageNoForUpdate, messageBoardStore.messageContent)">
            <label for="message_content">留言內容</label> <input type="text" name="message_content"
              v-model="messageBoardStore.sparkActivityNo">
            <label for="spark_activity_no">星火活動編號</label> <input type="text" name="spark_activity_no"
              v-model="messageBoardStore.messageContent">
            <label for="member_no">會員編號</label> <input type="text" name="member_no"
              v-model="messageBoardStore.memberNo">
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn class="cancel btn" variant="text" @click="closeDialog">
                取消
              </v-btn>
              <v-btn class="delete btn" variant="text" type="submit">
                確定
              </v-btn>
            </v-card-actions>
          </form>
        </v-card-text>2
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

label {
  @include flex_hm();
}

.text-h5 {
  color: $primaryBrandBlue;
  @include h5_PC;
  font-weight: 900;

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
  margin-bottom: 50px;
  margin-right: 20px;
}

:deep(.v-btn__content) {
  font-size: 20px;
}</style>