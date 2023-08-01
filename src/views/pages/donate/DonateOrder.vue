<script setup>
import { ref, reactive, computed } from 'vue'
const page = ref(1)

// 換頁
const itemsPerPage = 10;
const pageCount = () => {
  return (donateOrderList.length) / itemsPerPage + 1;
}
const displayDonateOrderList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return donateOrderList.slice(startIdx, endIdx);
});


const donateOrderList = reactive([
  {
    id: 'DO001',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO002',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO003',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO004',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO005',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO006',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO007',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO008',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO009',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO010',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO011',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO012',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO013',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO014',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  },
  {
    id: 'DO015',
    memId: 'A001',
    donateProject: '扶幼捐款',
    donatePrice: '500',
    donateDate: '2023-06-27',
  }

])

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>認養管理｜捐款訂單</h1>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>捐款訂單編號</th>
              <th>會員編號</th>
              <th>捐款專案</th>
              <th>捐款金額</th>
              <th>捐款日期</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayDonateOrderList" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>              <td class="id">{{ item.id }}</td>
              <td class="mem_id">{{ item.memId }}</td>
              <td class="donate_project">{{ item.donateProject }}</td>
              <td class="donate_price">{{ item.donatePrice }}</td>
              <td class="donate_date">{{ item.donateDate }}</td>
            </tr>
          </tbody>
        </v-table>
      </div>
        <v-btn class="add" color="#1D3D6C" :ripple="false" rounded="xl" size="x-large"
          variant="flat">新增</v-btn>

        <!-- 分頁 -->
        <div class="text-center">
          <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
            next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
        </div>
      </div>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/donate/donate-order";
</style>
