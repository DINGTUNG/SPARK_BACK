<script setup>
import CreateDreamStar from '@/views/create-dialog/CreateDreamStar.vue';
import UpdateDreamStar from '@/views/update-dialog/UpdateDreamStar.vue';
import Search from '@/components/Search.vue';
import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';

const page = ref(1)
const dialog = ref(false)

const dialogDelete = ref(false); // 控制刪除對話框的顯示
const itemToDelete = ref(null); // 存儲要刪除的項目

function showDeleteDialog(item) {
  itemToDelete.value = item; // 存儲要刪除的項目
  dialogDelete.value = true; // 顯示刪除對話框
}

function deleteItemConfirm() {
  if (itemToDelete.value) {
    const index = dreamStarList.indexOf(itemToDelete.value);
    if (index !== -1) {
      dreamStarList.splice(index, 1); // 從列表中刪除項目沒效 
    }
    itemToDelete.value = null;
    dialogDelete.value = false; // 隱藏刪除對話框
  }
}

function closeDelete() {
  dialogDelete.value = false; // 隱藏刪除對話框
}



// 換頁功能
const itemsPerPage = 10;
const pageCount = () => {
  return (dreamStarList.length) / itemsPerPage + 1;
}
const displayedDreamStarList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return dreamStarList.slice(startIdx, endIdx);
});


// 串接資料庫
const dreamStarList = reactive([])
async function dreamStarConnection() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/activity/dream-star/dream_star.php')
    console.log(response)
    if (response.data.length > 0) {
      response.data.forEach(element => {
        dreamStarList.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}
onMounted(() => {
  dreamStarConnection()
})


// 查詢功能
const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(searchValue.value);
}

const filteredDreamStarList = computed(() => {
  const searchText = searchValue.value.toString().toLowerCase(); // 確保將 searchValue 轉換為字符串並進行小寫轉換

  return displayedDreamStarList.value.filter(item => {
    const idMatch = item.dream_star_id.toString().includes(searchText);
    const nameMatch = item.dream_star_name.toLowerCase().includes(searchText);
    const onlineStatusMatch = item.is_dream_star_online.toString().includes(searchText);
    const indexMatch = ((page.value - 1) * itemsPerPage) + displayedDreamStarList.value.indexOf(item) + 1 === parseInt(searchText);
    return idMatch || nameMatch || onlineStatusMatch || indexMatch;
  });
});

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>夢想之星</h1>
      <div class="search">
        <Search :placeholder="'請輸入計畫資訊'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>計畫編號</th>
              <th>計畫名稱</th>
              <th>狀態</th>
              <th>功能</th>
              <th>刪改</th>

            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredDreamStarList" :key="item.dream_star_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.dream_star_id }}</td>
              <td class="name">{{ item.dream_star_name }}</td>
              <td class="online">{{ item.is_dream_star_online ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td>
              <td class="update_and_delete">
                <UpdateDreamStar />
                <!-- <v-icon size="small" class="me-2" @click="editItem(item)">
                  mdi-pencil
                </v-icon> -->
                <v-icon size="small" @click="showDeleteDialog(item)">mdi-delete</v-icon>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateDreamStar class="add" />
      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>

    <v-dialog v-model="dialogDelete" max-width="800px" persistent>
      <v-card class="delete_dialog">
        <v-card-title class="text-center">
          是否確定要刪除此計畫？
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
@import "@/assets/sass/pages/activity/dream-star";
</style>
