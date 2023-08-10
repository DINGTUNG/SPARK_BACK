<script setup>
import CreateReports from '@/views/create-dialog/CreateReports.vue';
import UpdateReports from '@/views/update-dialog/UpdateReports.vue';
import DeleteReport from '@/views/delete-dialog/DeleteReport.vue';
import Search from '@/components/Search.vue';
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { useReportStore } from '@/stores/reports.js';
const reportStore = useReportStore();

// 分頁
const pageCount = () => {
  return Math.ceil(reportStore.reportsList.length / itemsPerPage);
}
const page = ref(1)
const itemsPerPage = 10;
const displayReportsList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return reportStore.reportsList.slice(startIdx, endIdx);
});
// 分頁

//api
async function reportConnection() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/results/reports/reports.php')
    reportStore.reportsList.splice(0);
    if (response.data.length > 0) {
      response.data.forEach(element => {
        reportStore.reportsList.push(element);
      });
    }
  } catch (error) {
    console.error(error);
  }
}
onMounted(() => {
  reportConnection()
})
//api

const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(newValue);
};

const filteredReportList = computed(() => {
  const searchText = searchValue.value ? searchValue.value.trim().toUpperCase() : '';
  return displayReportsList.value.filter((item, index) => { // 修改这里
    const idMatch = item.report_id.toString() === searchText;
    if (isNaN(parseInt(searchText))) {
      const nameMatch = item.report_title.toLowerCase().includes(searchText);
      const onlineStatusMatch = item.is_report_online.toString().includes(searchText);
      const indexMatch = index === parseInt(searchText) - 1; // 修改这里
      return idMatch || nameMatch || onlineStatusMatch || indexMatch;
    } else {
      return idMatch;
    }
  });
});
</script>
<template>
  <div class="container">
    <div class="content_wrap">
      <h1>成果管理｜歷年報告</h1>
      <div class="search">
        <Search :placeholder="'請輸入報告資訊'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>報告id</th>
              <th>類別</th>
              <th>年度</th>
              <th>名稱</th>
              <th>狀態</th>
              <th>功能</th>
              <th>更新者</th>
              <th>更新時間</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredReportList" :key="item.report_no" class="no-border">
              <td class="no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.report_id }}</td>
              <td class="class">{{ item.report_class }}</td>
              <td class="year">{{ item.report_year }}</td>
              <td class="name">{{ item.report_title }}</td>
              <td class="online">{{ item.is_report_online == 1 ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.is_report_online" color="#EBC483" density="compact" hide-details="true" inline inset></v-switch>
              </td>
              <td class="year">{{ item.updater }}</td>
              <td class="name">{{ item.update_time }}</td>
              <td class="update_and_delete">
                <UpdateReports />
                <DeleteReport :reportNoForDelete="parseInt(item.report_no)"/>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateReports class="add" />
      <div class="text-center">
        <v-pagination v-model="page" :length=pageCount() rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
@import "@/assets/sass/pages/results/reports";
</style>
