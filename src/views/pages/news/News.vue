<script setup>
import popUpNews from '@/views/pop-ups/popUpNews.vue';

import { ref, reactive, computed } from 'vue'
const page = ref(1)
const dialog = ref(false)

const dialogDelete = ref(false); // 控制刪除對話框的顯示
const itemToDelete = ref(null); // 存儲要刪除的項目

function showDeleteDialog(item) {
  itemToDelete.value = item; // 存儲要刪除的項目
  console.log(itemToDelete)
  dialogDelete.value = true; // 顯示刪除對話框
}

function deleteItemConfirm() {
  if (itemToDelete.value) {
    const index = news.indexOf(itemToDelete.value);
    if (index !== -1) {
      news.splice(index, 1); // 從列表中刪除項目沒效 
    }
    itemToDelete.value = null;
    dialogDelete.value = false; // 隱藏刪除對話框
  }
}

function closeDelete() {
  dialogDelete.value = false; // 隱藏刪除對話框
}

// 換頁
const pageCount = () => {
  return (news.length) / itemsPerPage + 1;
}
// 換頁
const itemsPerPage = 10;
const displayedNewsList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return news.slice(startIdx, endIdx);
});


const news = reactive([
  {
    id: '001',
    name: '星火30，感謝有您',
    date: '2023.01.17',
  },
])

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>最新消息</h1>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>消息編號</th>
              <th>消息名稱</th>
              <th>日期</th>
              <th>狀態</th>
              <th>功能</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayedNewsList" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="td_id">{{ item.id }}</td>
              <td class="name">{{ item.name }}</td>
              <td class="date">{{ item.date }}</td>
              <td class="online">{{ item.online ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td>
              <td>
                <v-icon size="small" class="me-2" @click="editItem(item)">
                  mdi-pencil
                </v-icon>
                <v-icon size="small" @click="showDeleteDialog(item)">mdi-delete</v-icon>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <popUpNews class="add" />
      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length=pageCount() rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
    <v-dialog v-model="dialogDelete" max-width="800px" :persistent="true">
      <v-card class="delete_dialog">
        <v-card-title class="text-center">
          確定是否要刪除此消息？
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="#F2DFBF" variant="text" @click="closeDelete">
            取消
          </v-btn>
          <v-btn color="#F2DFBF" variant="text" @click="deleteItemConfirm">
            刪除
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>


  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/news/news";
</style>
