<script setup>
import Search from '@/components/Search.vue';
import CreateDonateProject from '@/views/create-dialog/donate/CreateDonateProject.vue';
import UpdateDonateProject from '@/views/update-dialog/donate/UpdateDonateProject.vue';
import DeleteDonateProject from '@/views/delete-dialog/donate/DeleteDonateProject.vue';

import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';
import { useDonateStore } from '@/stores/donate/donate-project.js';
const DonateStore = useDonateStore();


// 串接資料庫
async function donateConnection() {
  try {
    const response = await axios.post('https://tibamef2e.com/chd102/g3/back-end/php/donate/donate-project/get_donate_project.php')
    // const response = await axios.post('http://localhost/SPARK_BACK/php/donate/donate-project/get_donate_project.php')
    DonateStore.donatePool.splice(0); //重新載入時把資料清空再倒進來，資料就不會重複增加
    if (response.data.length > 0) {
      response.data.forEach(element => {
        DonateStore.donatePool.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}
onMounted(() => {
  donateConnection()
})


// 換頁功能
const page = ref(1)
const itemsPerPage = 10;
const pageCount = computed(() => {
  return Math.ceil(DonateStore.donatePool.length / itemsPerPage);
});
const displayedDonateList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return filteredDonateList.value.slice(startIdx, endIdx);
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

const filteredDonateList = computed(() => {
  return DonateStore.donatePool.filter((item) => {
    const obj = [item.donate_project_id, item.donate_project_name, item.donate_project_start_date, item.donate_project_end_date,]
    const str = JSON.stringify(obj);
    return str.includes(searchText.value)
  });
});

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>捐款管理｜捐款專案</h1>
      <div class="search">
        <Search :placeholder="'請輸入ID/專案名稱/日期'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>

              <th>專案ID</th>
              <th>專案名稱</th>
              <th>開始日期</th>
              <th>結束日期</th>
              <th>狀態</th>
              <th>功能</th>
              <th>創建者</th>
              <th>創建時間</th>
              <th>更新者</th>
              <th>更新時間</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayedDonateList" :key="item.donate_project_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>


              <td class="donate_project_id">{{ item.donate_project_id }}</td>
              <td class="donate_project_name">{{ item.donate_project_name }}</td>
              <td class="donate_project_start_date">{{ item.donate_project_start_date }}</td>
              <td class="donate_project_end_date">{{ item.donate_project_end_date }}</td>
              <td class="is_donate_project_online">{{ item.is_donate_project_online ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td>
              <td class="register">{{ item.register }}</td>
              <td class="regist_time">{{ item.regist_time }}</td>
              <td class="updater">{{ item.updater }}</td>
              <td class="update_time">{{ item.update_time }}</td>
              <td class="update_and_delete">
                <UpdateDonateProject :donateNoForUpdate="parseInt(item.donate_project_no)"
                  :donateNameForUpdate="item.donate_project_name"
                  :donateStartDateForUpdate="item.donate_project_start_date"
                  :donateEndDateForUpdate="item.donate_project_end_date"
                  :donateSummarizeForUpdate="item.donate_project_summarize"
                  :donateImageForUpdate="item.donate_project_image" />
                <!-- <v-icon size="small" class="me-2" @click="editItem(item.raw)">
                  mdi-pencil
                </v-icon> -->
                <DeleteDonateProject :donateNoForDelete="parseInt(item.donate_project_no)" />
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateDonateProject class="add" />

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>

  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/donate/donate-project";
</style>
