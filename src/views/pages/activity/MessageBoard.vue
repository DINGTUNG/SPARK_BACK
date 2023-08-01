<script setup>
import { ref, reactive, computed } from 'vue'

const page = ref(1)

// 換頁
const itemsPerPage = 10;
const pageCount = () => {
  return (messageList.length) / itemsPerPage + 1;
}
const displayMessageListList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return messageList.slice(startIdx, endIdx);
});


const messageList = reactive([
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },
  {
    id: 'M001',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    messageContent: '狸貓啾啾叫!',
    memID: 'A228',
    messageDate: '2002-02-02 02:02:02',
  },

])

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
              <th>留言id</th>
              <th>星火活動編號</th>
              <th>星火活動名稱</th>
              <th>留言內容</th>
              <th>會員編號</th>
              <th>留言時間</th>
              <th>刪除</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayMessageListList" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.id }}</td>
              <td class="sparkActivityNo">{{ item.sparkActivityNo }}</td>
              <td class="sparkActivityName">{{ item.sparkActivityName }}</td>
              <td class="messageContent">{{ item.messageContent }}</td>
              <td class="memID">{{ item.memID }}</td>
              <td class="messageDate">{{ item.messageDate }}</td>
              <td>
                <v-icon size="small" @click="showDeleteDialog(item.raw)">mdi-delete</v-icon>
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
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/activity/message-board";
</style>
