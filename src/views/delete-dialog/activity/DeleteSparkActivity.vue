<script setup>
import { ref, defineProps } from 'vue'
import { useMessageBoardStore } from '@/stores/activity/message-board.js';
const messageBoardStore = useMessageBoardStore();

const vueProps = defineProps({
  messageNoForDelete: Number
})

const dialogDisplay = ref(false);

function showDeleteDialog() {
  dialogDisplay.value = true;
}

function closeDeleteDialog() {
  dialogDisplay.value = false;
}

async function deleteMessage(messageNoForDelete) {
  try {
    if (messageNoForDelete == null) {
      throw new Error("Message no. not found!")
    }
    await messageBoardStore.deleteMessageBackend(messageNoForDelete)
    messageBoardStore.deleteMessageFromMessagePool(messageNoForDelete)
    window.alert(`刪除成功!剩下 ${messageBoardStore.messagePool.length} 筆資料`);
  } catch (error) {
    console.error(error);
    window.alert(`http status : ${error.response.data} 刪除失敗!請聯絡管理員!`);
  } finally {
    closeDeleteDialog()
  }
}

</script>

<template>
  <v-row class="row" style="flex: 0 0 0;">
    <v-dialog v-model="dialogDisplay" persistent>
      <template v-slot:activator="{ props }">
        <v-icon size="small" class="me-2 icon" v-bind="props" @click="showDeleteDialog">mdi-delete</v-icon>
      </template>
      <v-card class="delete_dialog" style="border-radius: 50px;">
        <v-card-title class="text-center title">
          確定是否要刪除此捐款專案？
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn class="cancel btn" variant="text" @click="closeDeleteDialog">
            取消
          </v-btn>
          <v-btn class="delete btn" variant="text" @click="deleteMessage(vueProps.messageNoForDelete)">
            刪除
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<style scoped lang="scss">
.v-row+.v-row {
  margin-top: 0;
}

:deep(.delete_dialog) {
  margin: auto;
  width: 50vw;
  height: 30vh;
  border-radius: 50px;
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

:deep(.delete) {
  background-color: $primaryBrandBlue;

  .v-btn__content {
    color: white;
  }
}


:deep(.title) {
  font-size: 1.5vw;
  margin: 3vw;
}

:deep(.v-btn__content) {
  font-size: 1vw;
}


:deep(.icon) {
  @include btnEffect;
}
</style>