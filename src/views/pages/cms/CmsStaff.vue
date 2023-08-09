<script setup>
import CreateCmsStaff from '@/views/create-dialog/CreateCmsStaff.vue';
import UpdateCmsStaff from '@/views/update-dialog/UpdateCmsStaff.vue';
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
      const index = staffList.indexOf(itemToDelete.value);
      if (index !== -1) {
        staffList.splice(index, 1); // 從列表中刪除項目沒效 
      }
    }
    itemToDelete.value = null; // 清空要刪除的項目
  }
}

// 換頁功能
const itemsPerPage = 10;
const pageCount = () => {
  return (staffList.length) / itemsPerPage + 1;
}
const displayedStaffList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return staffList.slice(startIdx, endIdx);
});

// 串接資料庫
const staffList = reactive([])
async function staffConnection() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/cms/cms_staff.php')
    console.log(response)
    if (response.data.length > 0) {
      response.data.forEach(element => {
        staffList.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}
onMounted(() => {
  staffConnection()
})

// 查詢功能
const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(searchValue.value);
}

const filteredStaffList = computed(() => {
  const searchText = searchValue.value.toString().toLowerCase(); // 確保將 searchValue 轉換為字符串並進行小寫轉換

  return displayedStaffList.value.filter(item => {
    const idMatch = item.staff_id.toString().includes(searchText);
    const nameMatch = item.staff_name.toLowerCase().includes(searchText);
    const permissionMatch = item.staff_permission.toString().includes(searchText);
    const emailMatch = item.staff_email.toString().includes(searchText);
    const accountMatch = item.staff_account.toString().includes(searchText);
    const passwordMatch = item.staff_password.toString().includes(searchText);
    const indexMatch = ((page.value - 1) * itemsPerPage) + displayedStaffList.value.indexOf(item) + 1 === parseInt(searchText);
    return idMatch || nameMatch || permissionMatch || emailMatch || accountMatch || passwordMatch || indexMatch;
  });
});

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>後台管理｜後台人員</h1>
      <div class="search">
        <Search :placeholder="'請輸入人員資訊'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>人員編號</th>
              <th>人員ID</th>
              <th>人員姓名</th>
              <th>權限名稱</th>
              <th>Email</th>
              <th>帳號</th>
              <th>密碼</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredStaffList" :key="item.staff_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>

              <td class="staff_no">{{ item.staff_no }}</td>
              <td class="staff_id">{{ item.staff_id }}</td>
              <td class="staff_name">{{ item.staff_name }}</td>
              <td class="staff_permission">{{ item.staff_permission }}</td>
              <td class="staff_email">{{ item.staff_email }}</td>
              <td class="staff_account">{{ item.staff_account }}</td>
              <td class="staff_password">{{ item.staff_password }}</td>
              <td class="update_and_delete">
                <UpdateCmsStaff />
                <!-- <v-icon size="small" class="me-2" @click="editItem(item.raw)" v-show="index !== 0">
                  mdi-pencil
                </v-icon> -->
                <v-icon size="small" @click="showDeleteDialog(item.raw)" v-show="index !== 0">mdi-delete</v-icon>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateCmsStaff class="add" />

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>

    <v-dialog v-model="dialogDelete" max-width="800px" persistent>

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

