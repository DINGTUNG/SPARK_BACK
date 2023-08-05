<script setup>
import PopUpCmsStaff from '@/views/pop-ups/PopUpCmsStaff.vue';

import { ref, reactive, computed } from 'vue'
const page = ref(1)

const dialogDelete = ref(false); // 控制刪除對話框的顯示
const itemToDelete = ref(null); // 存儲要刪除的項目

function showDeleteDialog(item) {
  itemToDelete.value = item; // 存儲要刪除的項目
  dialogDelete.value = true; // 顯示刪除對話框
}

function deleteItemConfirm() {
  // 不直接執行刪除操作，僅關閉刪除對話框，讓使用者確認是否刪除
  closeDelete(); // 關閉刪除對話框
}

function closeDelete() {
  dialogDelete.value = false; // 隱藏刪除對話框
  if (itemToDelete.value) {
    const confirmDelete = confirm("是否確定要刪除？");
    if (confirmDelete) {
      const index = donateList.indexOf(itemToDelete.value);
      if (index !== -1) {
        donateList.splice(index, 1); // 從列表中刪除項目沒效 
      }
    }
    itemToDelete.value = null; // 清空要刪除的項目
  }
}

// 換頁
const itemsPerPage = 10;
const pageCount = () => {
  return (donateList.length) / itemsPerPage + 1;
}
const displayedDonateList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return donateList.slice(startIdx, endIdx);
});


const donateList = reactive([
  {
    no: '1',
    id: 'CMS001',
    name: '星太郎',
    permission: '超級管理員',
    email: 'test@gmail.com',
    account: 'test',
    password: 'test',
  },
  {
    no: '2',
    id: 'CMS002',
    name: '星八克',
    permission: '一般管理員',
    email: 'spark@gmail.com',
    account: 'spark',
    password: 'spark',
  },
  {
    no: '3',
    id: 'CMS003',
    name: '星琪六',
    permission: '協作人員',
    email: '666@gmail.com',
    account: '666',
    password: '666',
  },
])

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>後台管理｜後台人員</h1>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>人員編號</th>
              <th>人員姓名</th>
              <th>權限名稱</th>
              <th>Email</th>
              <th>帳號</th>
              <th>密碼</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayedDonateList" :key="index" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.id }}</td>
              <td class="name">{{ item.name }}</td>
              <td class="permission">{{ item.permission }}</td>
              <td class="email">{{ item.email }}</td>
              <td class="account">{{ item.account }}</td>
              <td class="password">{{ item.password }}</td>
              <!-- <td class="online">{{ item.online ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td> -->
              <td>
                <v-icon size="small" class="me-2" @click="editItem(item.raw)" v-show="index !== 0">
                  mdi-pencil
                </v-icon>
                <v-icon size="small" @click="showDeleteDialog(item.raw)" v-show="index !== 0">mdi-delete</v-icon>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <PopUpCmsStaff class="add" />

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>

    <v-dialog v-model="dialogDelete" max-width="800px" persistent="true">

      <v-card class="delete_dialog">
        <v-card-title class="text-center">
          是否確定要刪除此人員資料？
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
@import "@/assets/sass/pages/cms/cms-staff";
</style>

