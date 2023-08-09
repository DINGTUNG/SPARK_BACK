<script setup>
import CreateDonateProject from '@/views/create-dialog/CreateDonateProject.vue';
import UpdateDonateProject from '@/views/update-dialog/UpdateDonateProject.vue';
import Search from '@/components/Search.vue';
import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';

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


// 換頁功能
const itemsPerPage = 10;
const pageCount = () => {
  return (donateList.length) / itemsPerPage + 1;
}
const displayedDonateList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return donateList.slice(startIdx, endIdx);
});

// 串接資料庫
const donateList = reactive([])
async function donateConnection() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/donate/donate-project/donate_project.php')
    console.log(response)
    if (response.data.length > 0) {
      response.data.forEach(element => {
        donateList.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}
onMounted(() => {
  donateConnection()
})


// 查詢功能
const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(searchValue.value);
}

const filteredDonateList = computed(() => {
  const searchText = searchValue.value.toString().toLowerCase(); // 確保將 searchValue 轉換為字符串並進行小寫轉換

  return displayedDonateList.value.filter(item => {
    const idMatch = item.donate_project_id.toString().includes(searchText);
    const nameMatch = item.donate_project_name.toLowerCase().includes(searchText);
    const startDateMatch = item.donate_project_start_date.toString().includes(searchText);
    const endDateMatch = item.donate_project_end_date.toString().includes(searchText);
    const onlineStatusMatch = item.is_donate_project_online.toString().includes(searchText);
    const indexMatch = ((page.value - 1) * itemsPerPage) + displayedDonateList.value.indexOf(item) + 1 === parseInt(searchText);
    return idMatch || nameMatch || startDateMatch || endDateMatch || onlineStatusMatch || indexMatch;
  });
});

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>捐款管理｜捐款專案</h1>
      <div class="search">
        <Search :placeholder="'請輸入專案資訊'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>專案編號</th>
              <th>專案名稱</th>
              <th>開始日期</th>
              <th>結束日期</th>
              <th>狀態</th>
              <th>功能</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredDonateList" :key="item.donate_project_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.donate_project_id }}</td>
              <td class="name">{{ item.donate_project_name }}</td>
              <td class="start_date">{{ item.donate_project_start_date }}</td>
              <td class="end_date">{{ item.donate_project_end_date }}</td>
              <td class="online">{{ item.is_donate_project_online ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td>
              <td class="update_and_delete">
                <UpdateDonateProject />
                <!-- <v-icon size="small" class="me-2" @click="editItem(item.raw)">
                  mdi-pencil
                </v-icon> -->
                <v-icon size="small" @click="showDeleteDialog(item.raw)">mdi-delete</v-icon>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateDonateProject class="add" />

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>

    <v-dialog v-model="dialogDelete" max-width="800px" persistent>

      <v-card class="delete_dialog">
        <v-card-title class="text-center">
          確定是否要刪除此捐款專案？
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
@import "@/assets/sass/pages/donate/donate-project";
</style>
