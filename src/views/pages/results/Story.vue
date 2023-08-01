<script setup>
import { ref, reactive,computed  } from 'vue'
const page = ref(1)

const storyList = reactive([
  {
    no : 1,
    id : "ST001",
    title : "遊戲場上的友誼結盟",
    date : '2023.04.12',
    online : 0
  },
  {
    no : 2,
    id : "ST002",
    title : "音樂天使的樂章演奏",
    date : '2023.04.16',
    online : 0
  },
  {
    no : 3,
    id : "ST003",
    title : "探索奇妙的科學之旅",
    date : '2023.04.20',
    online : 0
  },
  {
    no : 4,
    id : "ST004",
    title : "畫筆舞動的創意世界",
    date : '2023.04.27',
    online : 0
  },
])


// 換頁
const itemsPerPage = 8;
  const displayedDonateList = computed(() => {
    const startIdx = (page.value - 1) * itemsPerPage;
    const endIdx = startIdx + itemsPerPage;
    return donateList.slice(startIdx, endIdx);
  });


</script>


<template>
  <div class="container">

    <div class="table_body">

      <h1>捐款管理｜捐款專案</h1>
      <v-table>
        <thead>
          <tr>
            <th>No.</th>
            <th>事紀編號</th>
            <th>事紀標題</th>
            <th>事紀日期</th>
            <th>狀態</th>
            <th>功能</th>
            <th>刪改</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in storyList" :key="item.id" class="no-border">
            <td class="td_no">{{ item.no }}</td>
            <td class="id">{{ item.id }}</td>
            <td class="name">{{ item.title }}</td>
            <td class="start_date">{{ item.date }}</td>
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

      <v-btn class="text" min-width="100" color="#1D3D6C" :ripple="false" rounded="xl" size="x-large" variant="flat">新增</v-btn>

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
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/donate/donate-project";
</style>
