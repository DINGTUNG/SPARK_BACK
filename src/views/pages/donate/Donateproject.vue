<script setup>
import { ref, reactive, computed } from 'vue'
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
const pageCount = () => {
  return (donateList.length) / itemsPerPage + 1;
}
const displayedDonateList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return donateList.slice(startIdx, endIdx);
});


const donateList = reactive([
  {
    no: '1',
    id: '001',
    name: '扶幼捐款',
    start_date: '2023.01.17',
    end_date: '2028.01.17',
  },
  {
    no: '2',
    id: '002',
    name: '兒童保護',
    start_date: '2023.03.08',
    end_date: '2028.03.08',
  },
  {
    no: '3',
    id: '003',
    name: '助養召集令',
    start_date: '2023.05.22',
    end_date: '2028.05.22',
  },
  {
    no: '4',
    id: '004',
    name: '獎助學金',
    start_date: '2023.06.27',
    end_date: '2028.06.27',
  },
  {
    no: '5',
    id: '005',
    name: '急難救助金',
    start_date: '2023.08.05',
    end_date: '2028.08.05',
  },
  {
    no: '6',
    id: '006',
    name: '營養補助',
    start_date: '2023.11.13',
    end_date: '2028.11.13',
  },
  {
    no: '7',
    id: '007',
    name: '特殊醫療照顧',
    start_date: '2023.12.26',
    end_date: '2028.12.26',
  },
  {
    no: '8',
    id: '008',
    name: '特殊節日送暖金',
    start_date: '2024.01.10',
    end_date: '2028.01.10',
  },
  {
    no: '9',
    id: '009',
    name: '扶幼捐款',
    start_date: '2023.01.17',
    end_date: '2028.01.17',
  },
  {
    no: '10',
    id: '010',
    name: '助養召集令',
    start_date: '2023.03.08',
    end_date: '2028.03.08',
  },
  {
    no: '11',
    id: '011',
    name: '獎助學金',
    start_date: '2023.05.22',
    end_date: '2028.05.22',
  },
  {
    no: '12',
    id: '012',
    name: '急難救助金',
    start_date: '2023.06.27',
    end_date: '2028.06.27',
  },
  {
    no: '13',
    id: '013',
    name: '獎助學金',
    start_date: '2023.08.05',
    end_date: '2028.08.05',
  },
  {
    no: '14',
    id: '014',
    name: '營養補助',
    start_date: '2023.11.13',
    end_date: '2028.11.13',
  },
  {
    no: '15',
    id: '015',
    name: '特殊醫療照顧',
    start_date: '2023.12.26',
    end_date: '2028.12.26',
  },
  {
    no: '16',
    id: '016',
    name: '營養補助',
    start_date: '2024.01.10',
    end_date: '2028.01.10',
  },
  {
    no: '17',
    id: '017',
    name: '助養召集令',
    start_date: '2023.08.05',
    end_date: '2028.08.05',
  },
  {
    no: '18',
    id: '018',
    name: '特殊醫療照顧',
    start_date: '2023.11.13',
    end_date: '2028.11.13',
  },
  {
    no: '19',
    id: '019',
    name: '扶幼捐款',
    start_date: '2023.12.26',
    end_date: '2028.12.26',
  },
  {
    no: '20',
    id: '020',
    name: '兒童保護',
    start_date: '2024.01.10',
    end_date: '2028.01.10',
  },
  {
    no: '21',
    id: '021',
    name: '助養召集令',
    start_date: '2023.08.05',
    end_date: '2028.08.05',
  },
  {
    no: '22',
    id: '022',
    name: '兒童保護',
    start_date: '2023.11.13',
    end_date: '2028.11.13',
  },
  {
    no: '23',
    id: '023',
    name: '營養補助',
    start_date: '2023.12.26',
    end_date: '2028.12.26',
  },
  {
    no: '24',
    id: '024',
    name: '特殊節日送暖金',
    start_date: '2024.01.10',
    end_date: '2028.01.10',
  },
])

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>捐款管理｜捐款專案</h1>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>專案編號</th>
              <th>專案名稱</th>
              <th>開始日期</th>
              <th>結束日期</th>
              <th>狀態</th>
              <th>功能</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayedDonateList" :key="index" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.id }}</td>
              <td class="name">{{ item.name }}</td>
              <td class="start_date">{{ item.start_date }}</td>
              <td class="end_date">{{ item.end_date }}</td>
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
      </div>
      <v-btn class="add" color="#1D3D6C" :ripple="false" rounded="xl" size="x-large" variant="flat">新增</v-btn>

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
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
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/donate/donate-project";
</style>
