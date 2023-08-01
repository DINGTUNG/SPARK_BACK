<script setup>
import { ref, reactive, computed } from 'vue'

const page = ref(1)

// 換頁
const itemsPerPage = 10;
const pageCount = () => {
  return (sponsorOrderList.length) / itemsPerPage + 1;
}
const displaySponsorOrderList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return sponsorOrderList.slice(startIdx, endIdx);
});


const sponsorOrderList = reactive([
  {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  },
  {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  }, {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  }, {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  }, {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  }, {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  }, {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  }, {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  }, {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  }, {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  }, {
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  },{
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  },{
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  },{
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  },{
    id: 'SO001',
    memId: 'A001',
    sponsorLocation: '台東星火',
    sponsorDate: '2023-08-01 10:10:10',
    sponsorPrice: '2000',
    paymentPlan: '月繳',
    paymentMethod: '信用卡',
    childrenNo: 'C087',
    expiryMonth: '202408',
  },
])

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>認養管理｜認養訂單</h1>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>認養訂單編號</th>
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
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displaySponsorOrderList" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.id }}</td>
              <td class="mem_id">{{ item.memId }}</td>
              <td class="sponsor_location">{{ item.sponsorLocation }}</td>
              <td class="sponsor_date">{{ item.sponsorDate }}</td>
              <td class="sponsor_price">{{ item.sponsorPrice }}</td>
              <td class="payment_plan">{{ item.paymentPlan }}</td>
              <td class="payment_method">{{ item.paymentMethod }}</td>
              <td class="children_no">{{ item.childrenNo }}</td>
              <td class="expiry_month">{{ item.expiryMonth }}</td>
              <td class="online">{{ item.status ? '繼續' : '終止' }}</td>
              <td>
                <v-switch v-model="item.status" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
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
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/sponsor/sponsor-order";
</style>
