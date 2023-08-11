<script setup>
import Search from '@/components/Search.vue';
import CreateMessagePractice from '@/views/create-dialog/activity/CreateMessagePractice.vue';
import UpdateMessagePractice from '@/views/update-dialog/activity/UpdateMessagePractice.vue';
import DeleteMessage from '@/views/delete-dialog/activity/DeleteMessage.vue';
import { ref, computed, onMounted } from 'vue'
import axios from 'axios';
import { useMessageBoardStore } from '@/stores/activity/message-board.js';
const messageBoardStore = useMessageBoardStore();

async function getData() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/activity/message-board/get_message.php')
    messageBoardStore.messagePool.splice(0);

    if (response.data.length > 0) {
      response.data.forEach(element => {
        messageBoardStore.messagePool.push(element)

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
  return Math.floor((messageBoardStore.messagePool.length - 1) / itemsPerPage) + 1;
}
const displayMessageList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return filteredMessageBoardPool.value.slice(startIdx, endIdx);
});

const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
}

const searchText = computed(() => {
  let searchText = searchValue.value ? searchValue.value.trim().toUpperCase() : '';
  if (!isNaN(+searchText)) {
    searchText = +searchText < 10 ? `0${searchText}` : searchText;
  }
  return searchText;
})

const filteredMessageBoardPool = computed(() => {
  return messageBoardStore.messagePool.filter((item) => {
    const obj = [item.message_id, item.member_id]
    const str = JSON.stringify(obj);
    return str.includes(searchText.value)
  });
});
</script>

<template>
  <div class="container">
    <div class="content_wrap">
      <h1>活動管理｜星火活動留言</h1>
      <div class="search">
        <Search :placeholder="'請輸入留言ID或會員ID'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>留言ID</th>
              <th>星火活動ID</th>
              <th>留言內容</th>
              <th>會員ID</th>
              <th>留言時間</th>
              <th>刪除</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayMessageList" :key="item.message_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="message_id">{{ item.message_id }}</td>
              <td class="spark_activity_id">{{ item.spark_activity_id }}</td>
              <td class="message_content">{{ item.message_content }}</td>
              <td class="member_id">{{ item.member_id }}</td>
              <td class="message_date">{{ item.message_date }}</td>
              <td class="update_and_delete">
                <UpdateMessagePractice :messageNoForUpdate="parseInt(item.message_no)"
                  :sparkActivityIdForUpdate="item.spark_activity_id" :messageContentForUpdate="item.message_content"
                  :memberIdForUpdate="item.member_id" />

                <DeleteMessage :messageNoForDelete="parseInt(item.message_no)" />
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateMessagePractice class="add" />
      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
  </div>  
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/activity/spark-activity";
</style>
