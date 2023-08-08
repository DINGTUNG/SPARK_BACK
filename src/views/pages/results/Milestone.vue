<script setup>
import Search from '@/components/Search.vue'; //查詢功能
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
      const index = milestoneList.indexOf(itemToDelete.value);
      if (index !== -1) {
        milestoneList.splice(index, 1); // 從列表中刪除項目沒效 
      }
    }
    itemToDelete.value = null; // 清空要刪除的項目
  }
}

// 換頁
const itemsPerPage = 10;
const pageCount = () => {
  return (milestoneList.length) / itemsPerPage + 1;
}
const displayedMilestoneList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return milestoneList.slice(startIdx, endIdx);
});

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


const donateList = reactive([
  // {
  //   no: '1',
  //   id: 'M001',
  //   title: '暖心聖誕',
  //   date: '202212',
  // },
  // {
  //   no: '2',
  //   id: 'M002',
  //   title: '環境小尖兵',
  //   date: '202302',
  // },
  // {
  //   no: '3',
  //   id: 'M003',
  //   title: '愛心稻田',
  //   date: '202306',
  // },
])

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>成果管理｜服務里程碑</h1>
      <div class="search">
        <Search :placeholder="'請輸入里程碑ID'" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>里程碑編號</th>
              <th>里程碑標題</th>
              <th>年度/月份</th>
              <th>狀態</th>
              <th>功能</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayedMilestoneList" :key="index" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.milestone_id }}</td>
              <td class="title">{{ item.milestone_title }}</td>  
              <td class="date">{{ item.milestone_date }}</td>
              <td class="online">{{ item.is_milestone_online ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td>
              <td>
                <v-icon size="small" class="me-2" @click="editItem(item.raw)">
                  mdi-pencil
                </v-icon>
                <v-icon size="small" @click="showDeleteDialog(item.raw)">mdi-delete</v-icon>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateDonateProject  class="add" />

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
@import "@/assets/sass/pages/results/milestone";
</style>
