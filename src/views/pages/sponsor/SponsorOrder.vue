<script setup>
import Search from '@/components/Search.vue';
import { ref, computed, onMounted } from 'vue'
import axios from 'axios';
import UpdateSponsorOrder from '@/views/update-dialog/sponsor/UpdateSponsorOrder.vue';
import { useSponsorOrderStore } from '@/stores/sponsor/sponsor-order.js';

const sponsorOrderStore = useSponsorOrderStore();

// get data from sponsor_order
async function getSponsorOrder() {
  try {
    const response = await axios.post('https://tibamef2e.com/chd102/g3/back-end/php/sponsor/sponsor-order/get_sponsor_order.php')
    sponsorOrderStore.sponsorOrderPool.splice(0);
    if (response.data.length > 0) {
      response.data.forEach(element => {
        sponsorOrderStore.sponsorOrderPool.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  getSponsorOrder()
})

// update order status
async function updateOrderStatus(item) {
  try {
    if (item.sponsor_order_no == null) {
      throw new Error("sponsor order no not found!")
    }
    await sponsorOrderStore.updateSponsorOrderStatusBackend(item.sponsor_order_no, item.order_status)
    sponsorOrderStore.updateOrderStatusFromSponsorOrderPool(item.sponsor_order_no, item.order_status)
  } catch (error) {
    console.error(error);
  }
}

// 換頁
const page = ref(1)
const itemsPerPage = 10;
const pageCount = () => {
  return Math.floor((sponsorOrderStore.sponsorOrderPool.length - 1) / itemsPerPage) + 1;
}
const displaySponsorOrderList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return filteredSponsorOrderList.value.slice(startIdx, endIdx);
});


const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
}

const searchText = computed(() => {
  let searchText = searchValue.value ? searchValue.value.trim().toUpperCase() : '';
  if (!isNaN(+searchText)) {
    searchText = +searchText < 10 ? `0${searchText}` : searchText;
  }
  return searchText;
})

const filteredSponsorOrderList = computed(() => {
  return sponsorOrderStore.sponsorOrderPool.filter((item) => {
    const obj = [item.sponsor_order_id, item.member_id]
    const str = JSON.stringify(obj);
    return str.includes(searchText.value)
  });
});


</script>

<template>
  <div class="container">
    <div class="content_wrap">
      <h1>認養管理｜認養訂單</h1>
      <div class="search">
        <Search :placeholder="'請輸入認養訂單ID或會員ID'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>認養訂單ID</th>
              <th>會員ID</th>
              <th>據點ID</th>
              <th>認養日期</th>
              <th>費用</th>
              <th>繳款專案</th>
              <th>繳款方式</th>
              <th>兒童ID</th>
              <th>繳款到期日</th>
              <th>訂單狀態</th>
              <th>功能</th>
              <th>更新者</th>
              <th>更新時間</th>
              <th>編輯</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displaySponsorOrderList" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="sponsor_order_id">{{ item.sponsor_order_id }}</td>
              <td class="member_id">{{ item.member_id }}</td>
              <td class="location_id">{{ item.location_id }}</td>
              <td class="sponsor_date">{{ item.sponsor_date }}</td>
              <td class="price">{{ item.price }}</td>
              <td class="payment_plan">{{ item.payment_plan }}</td>
              <td class="payment_method">{{ item.payment_method }}</td>
              <td class="children_id">{{ item.children_id }}</td>
              <td class="expiry_date">{{ item.expiry_date }}</td>
              <td class="order_status">{{ item.order_status ? "繼續" : "終止" }}</td>
              <td>
                <v-switch v-model="item.order_status" color="#EBC483" density="compact" hide-details="true" inline inset true-value=1 @change="updateOrderStatus(item)"></v-switch>
              </td>
              <td class="updater">{{ item.updater }}</td>
              <td class="update_time">{{ item.update_time }}</td>
              <td class="update_and_delete">
                <UpdateSponsorOrder :sponsorOrderNoForUpdate="parseInt(item.sponsor_order_no)"
                  :childrenIdForUpdate="item.children_id" />
              </td>
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
@import "@/assets/sass/pages/sponsor/sponsor-order";
</style>
