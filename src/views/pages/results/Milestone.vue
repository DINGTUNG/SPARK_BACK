<script setup>
//【引入】
import CreateMilestone from '@/views/create-dialog/results/CreateMilestone.vue'; //新增里程碑
import UpdateMilestone from '@/views/update-dialog/results/UpdateMilestone.vue'; //編輯里程碑
import Search from '@/components/Search.vue'; //查詢
import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';

//【刪除功能】
// const page = ref(1)
// const dialogDelete = ref(false); // 控制刪除對話框的顯示
// const itemToDelete = ref(null); // 存儲要刪除的項目

// function showDeleteDialog(item) {
//   itemToDelete.value = item; // 存儲要刪除的項目
//   dialogDelete.value = true; // 顯示刪除對話框
// }

// function deleteItemConfirm() {
//   if (itemToDelete.value) {
//     const index = milestoneList.indexOf(itemToDelete.value);
//     if (index !== -1) {
//       milestoneList.splice(index, 1); // 從列表中刪除項目沒效 
//     }
//     itemToDelete.value = null;
//     dialogDelete.value = false; // 隱藏刪除對話框
//   }
// }

// function closeDelete() {
//   dialogDelete.value = false; // 隱藏刪除對話框
// }

// 【換頁功能】
const itemsPerPage = 10;
const pageCount = () => {
  return (milestoneList.length) / itemsPerPage + 1;
}
const displayMilestoneList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return milestoneList.slice(startIdx, endIdx);
});

//【查詢功能】
const searchValue = ref('');
function handleSearchChange(event) {
  searchValue.value = event.target.value;
  console.log(searchValue.value);
}

const filteredMilestoneList = computed(() => {
  const searchText = searchValue.value.toString().toLowerCase(); // 確保將 searchValue 轉換為字符串並進行小寫轉換

  return displayMilestoneList.value.filter(item => {
    const noMatch = item.milestone_no.toString().includes(searchText);
    const idMatch = item.milestone_id.toString().includes(searchText);
    const titleMatch = item.milestone_title.toLowerCase().includes(searchText);
    const dateMatch = item.milestone_date.toString().includes(searchText);
    const onlineStatusMatch = ((item.is_milestone_online && '已上架'.includes(searchText)) || (!item.is_milestone_online && '未上架'.includes(searchText)));
    const indexMatch = ((page.value - 1) * itemsPerPage) + displayMilestoneList.value.indexOf(item) + 1 === parseInt(searchText);
    return noMatch || idMatch || titleMatch || dateMatch || onlineStatusMatch || indexMatch;
  });
});

//【資料庫連接】
const milestoneList = reactive([])
async function milestoneConnection() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/results/milestone/milestone.php')
    console.log(response)


    if (response.data.length > 0) {
      response.data.forEach(element => {
        milestoneList.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  milestoneConnection()
})

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>成果管理｜服務里程碑</h1>
      <div class="search">
        <Search :placeholder="'請輸入里程碑資訊'" :search-value="searchValue" @input="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>里程碑編號</th>
              <th>里程碑ID</th>
              <th>里程碑標題</th>
              <th>年度/月份</th>
              <th>狀態</th>
              <th>功能</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredMilestoneList" :key="item.milestone_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>

              <td class="milestone_no">{{ item.milestone_no }}</td>
              <td class="milestone_id">{{ item.milestone_id }}</td>
              <td class="milestone_title">{{ item.milestone_title }}</td>
              <td class="milestone_date">{{ item.milestone_date }}</td>
              <td class="is_milestone_online">{{ item.is_milestone_online ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td>
              <td class="update_and_delete">
                <UpdateMilestone />
                <!-- <v-icon size="small" @click="showDeleteDialog(item)">mdi-delete</v-icon> -->
                <DeleteMilestone :milestoneNoForDelete="parseInt(item.milestone_no)" />
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateMilestone class="add" />

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>

    <v-dialog v-model="dialogDelete" max-width="800px" persistent>

      <v-card class="delete_dialog">
        <v-card-title class="text-center">
          確定是否要刪除此里程碑？
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
@import "@/assets/sass/pages/results/milestone";
</style>
