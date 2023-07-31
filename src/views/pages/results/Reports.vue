<script setup>
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
  closeDelete(); // 關閉刪除對話框
}

function closeDelete() {
  dialogDelete.value = false; // 隱藏刪除對話框
  if (itemToDelete.value) {
    const confirmDelete = confirm("是否確定要刪除？");
    if (confirmDelete) {
      const index = donateList.indexOf(itemToDelete.value);
      if (index !== -1) {
        donateList.splice(index, 1); // 從列表中刪除項目沒效 
      }
    }
    itemToDelete.value = null; // 清空要刪除的項目
  }
}

// 換頁
const itemsPerPage = 10;
const displayedDonateList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return donateList.slice(startIdx, endIdx);
});



const reports = reactive([
  {
    no: '1',
    id:'001',
    class: '年度',
    year: '2018',
    name: "星火執行年度報告"
  },
  {
    no: '2',
    id:'002',
    class: '年度',
    year: '2019',
    name: "星火執行年度報告"
  },
  {
    no: '3',
    id:'003',
    class: '年度',
    year: '2020',
    name: "星火執行年度報告"
  },
  {
    no: '4',
    id:'004',
    class: '年度',
    year: '2021',
    name: "星火執行年度報告"
  },
  {
    no: '5',
    id:'005',
    class: '年度',
    year: '2022',
    name: "星火執行年度報告"
  },
  {
    no: '6',
    id:'006',
    class: '年度',
    year: '2023',
    name: "星火執行年度報告"
  },
  {
    no: '7',
    id:'007',
    class: '財務',
    year: '2018',
    name: "星火執行業務報告"
  },
  {
    no: '8',
    id:'008',
    class: '財務',
    year: '2019',
    name: "星火執行業務報告",
  },
  {
    no: '9',
    id:'009',
    class: '財務',
    year: '2020',
    name: "星火執行業務報告"
  },
  {
    no: '10',
    id:'010',
    class: '財務',
    year: '2021',
    name: "星火執行業務報告"
  },
  {
    no: '11',
    id:'011',
    class: '財務',
    year: '2022',
    name: "星火執行業務報告"
  },
  {
    no: '12',
    id:'012',
    class: '財務',
    year: '2023',
    name: "星火執行業務報告"
  },
])
</script>


<template>
  <div class="container">
    <div class="table_container">
      <div class="table_body">
        <h1>捐款管理｜捐款專案</h1>
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
            <tr v-for="item in reports" :key="item.id" class="no-border">
              <td class="no">{{ item.no }}</td>
              <td class="id">{{ item.id }}</td>
              <td class="class">{{ item.class }}</td>
              <td class="year">{{ item.year }}</td>
              <td class="name">{{ item.name }}</td>
              <td class="online">{{ item.online ? '已上架' : '未上架' }}</td>
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

        <v-btn class="add" color="#1D3D6C" :ripple="false" rounded="xl" size="x-large" variant="flat">新增</v-btn>

        <!-- 分頁 -->
        <div class="text-center">
          <v-pagination v-model="page" :length="3" rounded="circle" prev-icon="mdi-chevron-left"
            next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
        </div>
      </div>

      <v-dialog v-model="dialogDelete" max-width="800px" persistent="true">

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
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/donate/donate-project";
</style>
