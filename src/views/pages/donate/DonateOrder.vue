<script setup>
import Search from '@/components/Search.vue';
import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';

const donateOrderPool = reactive([])

async function getData() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/donate/donate-order/get_donate_order.php')

    if (response.data.length > 0) {
      response.data.forEach(element => {
        donateOrderPool.push(element)
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
  return Math.floor((donateOrderPool.length - 1) / itemsPerPage) + 1;
}
const displayDonateOrderPool = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return filteredDonateOrderPool.value.slice(startIdx, endIdx);
});

const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
}

const searchText = computed(() => {
  let searchText = searchValue.value ? searchValue.value.trim().toUpperCase() : '';
  if (!isNaN(+searchText)) {
    searchText = +searchText < 10 ? `0${searchText}`: searchText;
  }
  return searchText;
})

const filteredDonateOrderPool = computed(() => {
  return donateOrderPool.filter((item) => { 
    const obj = [item.donate_order_id, item.member_id]
    const str = JSON.stringify(obj);
    return str.includes(searchText.value)
  });
});
</script>

<template>
  <div class="container">
    <div class="content_wrap">
      <h1>認養管理｜捐款訂單</h1>
      <div class="search">
        <Search :placeholder="'請輸入捐款訂單ID或會員ID'" :search-value="searchValue" @search="handleSearchChange"/>
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>捐款訂單ID</th>
              <th>會員ID</th>
              <th>捐款專案ID</th>
              <th>捐款金額</th>
              <th>捐款日期</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayDonateOrderPool" :key="item.donate_order_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="donate_order_id">{{ item.donate_order_id }}</td>
              <td class="member_id">{{ item.member_id}}</td>
              <td class="donate_project_id">{{ item.donate_project_id }}</td>
              <td class="donate_price">{{ item.donate_price }}</td>
              <td class="donate_date">{{ item.donate_date }}</td>
            </tr>
          </tbody>
        </v-table>
      </div>

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
