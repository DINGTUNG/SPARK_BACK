<script setup>
import PopUpDreamStar from '@/views/pop-ups/PopUpDreamStar.vue';
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
const pageCount = () => {
  return (location.length) / itemsPerPage + 1;
}
const displayLocationList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return location.slice(startIdx, endIdx);
});



const location = reactive([
  {
    no: '1',
    id: '001',
    name: '美食大師 烹飪歷險記',
  },
  {
    no: '2',
    id: '002',
    name: '繪畫奇想 彩筆揮灑繽紛世界',
  },
  {
    no: '3',
    id: '003',
    name: '音樂星光 樂韻奏鳴的天空旅程',
  },
  {
    no: '4',
    id: '004',
    name: '體育勇者 挑戰極限勇者之旅',
  },
  {
    no: '5',
    id: '005',
    name: '環保探險家 地球奇幻護衛隊',
  },
  {
    no: '6',
    id: '006',
    name: '小科學家 探索神秘世界',
  },
  {
    no: '7',
    id: '007',
    name: '動物園園長 照顧和保護動物',
  },
  {
    no: '8',
    id: '008',
    name: '創意手作 動手創造分享喜悅',
  },
])
</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>夢想之星</h1>
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
            <tr v-for="(item, index) in displayLocationList" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
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
      </div>
      <PopUpDreamStar class="add" />
      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>

    <v-dialog v-model="dialogDelete" max-width="800px" :persistent="true">
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
