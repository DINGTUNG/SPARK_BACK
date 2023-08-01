<script setup>
import locationWindow from '@/views/templates/LocationWindow.vue';
import { ref, reactive, computed } from 'vue'
const page = ref(1)
const dialog = ref(false)

const dialogDelete = ref(false); // 控制刪除對話框的顯示
const itemToDelete = ref(null); // 存儲要刪除的項目

function showDeleteDialog(item) {
  itemToDelete.value = item; // 存儲要刪除的項目
  dialogDelete.value = true; // 顯示刪除對話框
}

function deleteItemConfirm() {
  
  // 不直接執行刪除操作，僅關閉刪除對話框，讓使用者確認是否刪除
  if (itemToDelete.value) {
    const confirmDelete = confirm("是否確定要刪除？");
    if (confirmDelete) {
      const index = location.indexOf(itemToDelete.value);
      if (index !== -1) {
        location.splice(index, 1); // 從列表中刪除項目沒效 
      }
    }
    itemToDelete.value = null; // 清空要刪除的項目
  } 
  dialogDelete.value = false;// 關閉刪除對話框
}

function closeDelete() {
  dialogDelete.value = false; // 隱藏刪除對話框
}



// 換頁
const pageCount = () => {
  return (location.length)/ itemsPerPage + 1;
}
// 換頁
const itemsPerPage = 10;
const displayedLocationList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return location.slice(startIdx, endIdx);
});



const location = reactive([
  {
    no: '1',
    id:'001',
    name: '台北星火',
  },
  {
    no: '2',
    id:'002',
    name: '台中星火',
  },
  {
    no: '3',
    id:'003',
    name: '台南星火',
  },
  {
    no: '4',
    id:'004',
    name: '台東星火',
  },
])
</script>


<template>
  <div class="container">
    <div class="table_container">
      <div class="table_body">
        <h1>認養據點</h1>
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
            <tr v-for="item in displayedLocationList" :key="item.id" class="no-border">
              <td class="td_no">{{ item.no }}</td>
              <td class="id">{{ item.id }}</td>
              <td class="name">{{ item.name }}</td>
              <td class="online">{{ item.online ? '已上架' : '未上架' }}</td>
              <td>
              <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td>
              <td>
                <v-icon size="small" class="me-2" @click="editItem(item)">
                  mdi-pencil
                </v-icon>
                <v-icon size="small" @click="showDeleteDialog(item)">mdi-delete</v-icon>
              </td>
            </tr>
          </tbody>
        </v-table>
        <locationWindow/> 
        <!-- 分頁 -->
        <div class="text-center">
          <v-pagination v-model="page" :length=pageCount() rounded="circle" prev-icon="mdi-chevron-left"
            next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
        </div>
      </div>

      <v-dialog v-model="dialogDelete" max-width="800px" :persistent="true">
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
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/donate/donate-project";
</style>
