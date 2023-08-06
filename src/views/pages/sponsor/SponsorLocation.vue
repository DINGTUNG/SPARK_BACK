<script setup>
import CreateLocation from '@/views/create-dialog/CreateLocation.vue';
import UpdateLocation from '@/views/update-dialog/UpdateLocation.vue';
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
    const index = location.indexOf(itemToDelete.value);
    if (index !== -1) {
      location.splice(index, 1); // 從列表中刪除項目沒效 
    }
    itemToDelete.value = null;
    dialogDelete.value = false; // 隱藏刪除對話框
  }
}

function closeDelete() {
  dialogDelete.value = false; // 隱藏刪除對話框
}



// 換頁
const itemsPerPage = 10;
const pageCount = computed(() => {
  return (displayLocationList.length) / itemsPerPage + 1;
});
const displayLocationList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return locationList.slice(startIdx, endIdx);
});


const locationList = reactive([])
async function localConnection() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/sponsor/sponsor_location.php')
    console.log(response)


    if (response.data.length > 0) {
      response.data.forEach(element => {
        locationList.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  localConnection()
})


const newLocation = ref(null);
function onLocalAdd(location) {
  newLocation.value = location;
  locationList.push(location)
}
</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>認養管理｜認養據點</h1>
      <div class="search">
        <Search :placeholder="'請輸入據點資訊'" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>據點編號</th>
              <th>據點名稱</th>
              <th>狀態</th>
              <th>功能</th>
              <th>刪改</th>

            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayLocationList" :key="item.location_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.location_id }}</td>
              <td class="name">{{ item.location_name }}</td>
              <td class="online">{{ item.is_sponsor_location_online ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td>
              <td class="update_and_delete">
                <UpdateLocation />
                <v-icon size="small" @click="showDeleteDialog(item)">mdi-delete</v-icon>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateLocation class="add" />
      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>

    <v-dialog v-model="dialogDelete" max-width="800px" persistent>
      <v-card class="delete_dialog">
        <v-card-title class="text-center">
          確定是否要刪除此據點？
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
@import "@/assets/sass/pages/sponsor/sponsor-location";
</style>
