<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';

const donateOrderList = reactive([])

async function getData() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/donate/get_donate_order.php')

    if (response.data.length > 0) {
      response.data.forEach(element => {
        donateOrderList.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  getData()
})

// 換頁
const page = ref(1)
const itemsPerPage = 10;
const pageCount = () => {
  return Math.floor((donateOrderList.length - 1) / itemsPerPage) + 1;
}
const displayDonateOrderList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return donateOrderList.slice(startIdx, endIdx);
});
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
              <th>捐款訂單id</th>
              <th>會員編號</th>
              <th>捐款專案編號</th>
              <th>捐款金額</th>
              <th>捐款日期</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayDonateOrderList" :key="item.donate_order_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="donate_order_no">{{ item.donate_order_no }}</td>
              <td class="donate_order_id">{{ item.donate_order_id }}</td>
              <td class="member_no">{{ item.member_no}}</td>
              <td class="donate_project_no">{{ item.donate_project_no }}</td>
              <td class="donate_price">{{ item.donate_price }}</td>
              <td class="donate_date">{{ item.donate_date }}</td>
            </tr>
          </tbody>
        </v-table>
      </div>

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
