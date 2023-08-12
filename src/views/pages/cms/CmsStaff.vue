<script setup>
import Search from '@/components/Search.vue';
import CreateCmsStaff from '@/views/create-dialog/cms/CreateCmsStaff.vue';
import UpdateCmsStaff from '@/views/update-dialog/cms/UpdateCmsStaff.vue';
import DeleteCmsStaff from '@/views/delete-dialog/cms/DeleteCmsStaff.vue';

import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';
import { useCmsStaffStore } from '@/stores/cms/cms-staff.js';
const cmsStaffStore = useCmsStaffStore();


// 串接資料庫
async function staffConnection() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/cms/get_staff.php')
    console.log(response)
    cmsStaffStore.staffPool.splice(0); //重新載入時把資料清空再倒進來，資料就不會重複增加
    if (response.data.length > 0) {
      response.data.forEach(element => {
        cmsStaffStore.staffPool.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}
onMounted(() => {
  staffConnection()
})

// 換頁功能
const page = ref(1)
const itemsPerPage = 10;
const pageCount = computed(() => {
  return Math.ceil(cmsStaffStore.staffPool.length / itemsPerPage);
});
const displayedStaffList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return filteredStaffList.value.slice(startIdx, endIdx);
});


// 查詢功能
const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(searchValue.value);
}

const searchText = computed(() => {
  let searchText = searchValue.value ? searchValue.value.trim() : '';
  if (!isNaN(+searchText)) {
    searchText = +searchText < 10 ? `0${searchText}` : searchText;
  }
  return searchText;
})

const filteredStaffList = computed(() => {
  return cmsStaffStore.staffPool.filter((item) => {
    const obj = [item.staff_id, item.staff_name, item.staff_permission, item.staff_email]
    const str = JSON.stringify(obj);
    return str.includes(searchText.value)
  });
});

// const filteredStaffList = computed(() => {
//   const searchText = searchValue.value.toString().toLowerCase(); // 確保將 searchValue 轉換為字符串並進行小寫轉換

//   return displayedStaffList.value.filter(item => {
//     const idMatch = item.staff_id.toString().includes(searchText);
//     const nameMatch = item.staff_name.toLowerCase().includes(searchText);
//     const permissionMatch = item.staff_permission.toString().includes(searchText);
//     const emailMatch = item.staff_email.toString().includes(searchText);
//     const accountMatch = item.staff_account.toString().includes(searchText);
//     const passwordMatch = item.staff_password.toString().includes(searchText);
//     const indexMatch = ((page.value - 1) * itemsPerPage) + displayedStaffList.value.indexOf(item) + 1 === parseInt(searchText);
//     return idMatch || nameMatch || permissionMatch || emailMatch || accountMatch || passwordMatch || indexMatch;
//   });
// });

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>後台管理｜後台人員</h1>
      <div class="search">
        <Search :placeholder="'請輸入ID/姓名/權限/Email'" :search-value="searchValue" @search="handleSearchChange" />
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
            <tr v-for="(item, index) in displayedStaffList" :key="item.staff_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>

              <td class="staff_no">{{ item.staff_no }}</td>
              <td class="staff_id">{{ item.staff_id }}</td>
              <td class="staff_name">{{ item.staff_name }}</td>
              <td class="staff_permission">{{ item.staff_permission }}</td>
              <td class="staff_email">{{ item.staff_email }}</td>
              <td class="staff_account">{{ item.staff_account }}</td>
              <td class="staff_password">{{ item.staff_password }}</td>
              <td class="update_and_delete">
                <UpdateCmsStaff :staffNoForUpdate="parseInt(item.staff_no)" :staffAccountForUpdate="item.staff_account"
                  :staffPasswordForUpdate="item.staff_password" />
                <!-- <v-icon size="small" class="me-2" @click="editItem(item.raw)" v-show="index !== 0">
                  mdi-pencil
                </v-icon> -->
                <DeleteCmsStaff :staffNoForDelete="parseInt(item.staff_no)" />
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateCmsStaff class="add" />

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>

  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/cms/cms-staff";
</style>

