<script setup>
import Search from '@/components/Search.vue';
import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';

const sponsorOrderList = reactive([])

async function getData() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/sponsor/get_sponsor_order.php')

    if (response.data.length > 0) {
      response.data.forEach(element => {
        sponsorOrderList.push(element)
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
  return Math.floor((sponsorOrderList.length - 1) / itemsPerPage) + 1;
}
const displaySponsorOrderList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return sponsorOrderList.slice(startIdx, endIdx);
});

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>認養管理｜認養訂單</h1>
      <div class="search">
        <Search :placeholder="'請輸入認養訂單ID'"/>
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>認養訂單編號</th>
              <th>認養訂單id</th>
              <th>會員編號</th>
              <th>據點名稱</th>
              <th>認養日期</th>
              <th>費用</th>
              <th>繳款專案</th>
              <th>繳款方式</th>
              <th>兒童編號</th>
              <th>繳款到期月份</th>
              <th>訂單狀態</th>
              <th>功能</th>
              <th>更新者</th>
              <th>更新時間</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displaySponsorOrderList" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="sponsor_order_no">{{ item.sponsor_order_no }}</td>
              <td class="sponsor_order_id">{{ item.sponsor_order_id }}</td>
              <td class="member_no">{{ item.member_no }}</td>
              <td class="location_no">{{ item.location_no }}</td>
              <td class="sponsor_date">{{ item.sponsor_date }}</td>
              <td class="price">{{ item.price }}</td>
              <td class="payment_plan">{{ item.payment_plan }}</td>
              <td class="payment_method">{{ item.payment_method }}</td>
              <td class="children_no">{{ item.children_no }}</td>
              <td class="expiry_month">{{ item.expiry_month }}</td>
              <td class="order_status">{{ item.order_status == 1 ? "繼續" : "終止" }}</td>
              <td>
                <v-switch v-model="item.order_status" color="#EBC483" density="compact" hide-details="true" inline inset
                  true-value=1></v-switch>
              </td>
              <td class="updater">{{ item.updater }}</td>
              <td class="update_time">{{ item.update_time }}</td>
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
