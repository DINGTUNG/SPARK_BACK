<script setup>
import CreateReports from '@/views/create-dialog/CreateReports.vue';
import UpdateReports from '@/views/update-dialog/UpdateReports.vue';
import Search from '@/components/Search.vue';
import { ref, reactive, computed, onMounted } from 'vue';
import axios from 'axios';
const dialogDelete = ref(false); // 控制刪除對話框的顯示
const itemToDelete = ref(null); // 存儲要刪除的項目

//彈窗
function showDeleteDialog(item) {
  itemToDelete.value = item; // 存儲要刪除的項目
  dialogDelete.value = true; // 顯示刪除對話框
}
//彈窗

function deleteItemConfirm() {
  if (itemToDelete.value) {
    const index = reports.indexOf(itemToDelete.value);
    if (index !== -1) {
      reports.splice(index, 1); // 從列表中刪除項目沒效 
    }
    itemToDelete.value = null;
    dialogDelete.value = false; // 隱藏刪除對話框
  }
}
function closeDelete() {
  dialogDelete.value = false; // 隱藏刪除對話框
}

// 分頁
const pageCount = () => {
  return Math.ceil(reportsList.length / itemsPerPage);
}
const page = ref(1)
const itemsPerPage = 10;
const displayReportsList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return reportsList.slice(startIdx, endIdx);
});
// 分頁

//api
const reportsList = reactive([])
async function reportConnection() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/results/reports/reports.php')
    console.log(response)

    if (response.data.length > 0) {
      response.data.forEach(element => {
        reportsList.push(element)
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
  return displayReportsList.value.filter(item => {
    const idMatch = item.report_id.toString() === `R00${searchText}`;
    if (isNaN(parseInt(searchText))) {
      const nameMatch = item.report_title.toLowerCase().includes(searchText);
      const onlineStatusMatch = item.is_report_online.toString().includes(searchText);
      const indexMatch = displayReportsList.value.indexOf(item) === parseInt(searchText) - 1;
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
              <th>報告編號</th>
              <th>類別</th>
              <th>年度</th>
              <th>名稱</th>
              <th>狀態</th>
              <th>功能</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredReportList" :key="item.id" class="no-border">
              <td class="no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.report_id }}</td>
              <td class="class">{{ item.report_class }}</td>
              <td class="year">{{ item.report_year }}</td>
              <td class="name">{{ item.report_title }}</td>
              <td class="online">{{ item.is_report_online ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td>
              <td class="update_and_delete">
                <UpdateReports />
                <v-icon size="small" @click="showDeleteDialog(item)">mdi-delete</v-icon>
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
    <v-dialog v-model="dialogDelete" max-width="800px" persistent>
      <v-card class="delete_dialog">
        <v-card-title class="text-center">
          確定是否要刪除此報告？
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
@import "@/assets/sass/pages/results/reports";
</style>
