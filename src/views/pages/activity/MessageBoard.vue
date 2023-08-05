<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';

const messageList = reactive([])
async function getData() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/activity/get_message_board.php')

    if (response.data.length > 0) {
      response.data.forEach(element => {
        messageList.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  getData()
})

// 換頁
const page = ref(1)
const itemsPerPage = 10;
const pageCount = () => {
  return Math.floor((messageList.length - 1) / itemsPerPage) + 1;
}
const displayMessageList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return messageList.slice(startIdx, endIdx);
});


const dialogDelete = ref(false); // 控制刪除對話框的顯示
const itemToDelete = ref(null); // 存儲要刪除的項目

function showDeleteDialog(item) {
  itemToDelete.value = item; // 存儲要刪除的項目
  dialogDelete.value = true; // 顯示刪除對話框
}

function deleteItemConfirm() {
  if (itemToDelete.value) {
    const index = messageList.indexOf(itemToDelete.value);
    if (index !== -1) {
      messageList.splice(index, 1); // 從列表中刪除項目沒效 
    }
    itemToDelete.value = null;
    dialogDelete.value = false; // 隱藏刪除對話框
  }
}

function closeDelete() {
  dialogDelete.value = false; // 隱藏刪除對話框
}

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>活動管理｜星火活動留言</h1>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>留言編號</th>
              <th>留言ID</th>
              <th>星火活動編號</th>
              <th>留言內容</th>
              <th>會員編號</th>
              <th>留言時間</th>
              <th>刪除</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayMessageList" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>

              <td class="message_no">{{ item.message_no }}</td>
              <td class="message_id">{{ item.message_id }}</td>
              <td class="spark_activity_no">{{ item.spark_activity_no }}</td>
              <td class="message_content">{{ item.message_content }}</td>
              <td class="member_no">{{ item.member_no }}</td>
              <td class="message_date">{{ item.message_date }}</td>
              <td>
                <v-icon size="small" @click="showDeleteDialog(item)">mdi-delete</v-icon>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
    <v-dialog v-model="dialogDelete" persistent="true">
      <v-card class="delete_dialog" style="border-radius: 50px;">
        <v-card-title class="text-center title">
          確定是否要刪除此捐款專案？
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn class="cancel btn" variant="text" @click="closeDelete">
            取消
          </v-btn>
          <v-btn class="delete btn" variant="text" @click="deleteItemConfirm">
            刪除
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/activity/message-board";
</style>
