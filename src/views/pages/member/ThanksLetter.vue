<script setup>
import Search from '@/components/Search.vue';
import CreateThanksLetter from '@/views/create-dialog/member/CreateThanksLetter.vue';
// import UpdateMessagePractice from '@/views/update-dialog/member/UpdateMessagePractice.vue';
// import DeleteMessage from '@/views/delete-dialog/member/DeleteMessage.vue';

import { ref,  reactive, computed , onMounted }  from 'vue'
import axios from 'axios';
import { useThanksLetterStore } from '@/stores/member/thanks-letter.js';
const thanksLetterStore = useThanksLetterStore();


//串接資料庫
async function thanksLetterConnection() {
  try {
    const response = await axios.post('http://localhost:8888/member/thanks_letter/thanks_letter.php')
    thanksLetterStore.thanksLetterPool.splice(0); //重新載入時把資料清空再倒進來，資料就不會重複增加

    if (response.data.length > 0) {
      response.data.forEach(element => {
        thanksLetterStore.thanksLetterPool.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  thanksLetterConnection()
})

// 換頁
const page = ref(1)
const itemsPerPage = 10;
const pageCount = () => {
  return Math.floor((thanksLetterStore.thanksLetterPool.length - 1) / itemsPerPage) + 1;
}
const displayedLetterList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return  thanksLetterStore.thanksLetterPool.slice(startIdx, endIdx);
});


//查詢功能
const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(searchValue.value);
}

const filteredLetterList = computed(() => {
  const searchText = searchValue.value.toString();
  // 確保將 searchValue 轉換為字符串並進行小寫轉換

  return displayedLetterList.value.filter(item => {
    const idMatch = item.thanks_letter_id.toString().includes(searchText);
    const childrenIdMatch = item.children_id.toString().includes(searchText);
    const memberIdMatch = item.member_id.toString().includes(searchText);
    const sponsorOrderIdMatch = item.sponsor_order_id.toString().includes(searchText);
    const receiveDateMatch = item.receive_date.toString().includes(searchText);
    const indexMatch = ((page.value - 1) * itemsPerPage) + displayedLetterList.value.indexOf(item) + 1 === parseInt(searchText);
    return idMatch || childrenIdMatch || memberIdMatch || sponsorOrderIdMatch || receiveDateMatch || indexMatch;
  });
});

</script>

<template>
  <div class="container">
    <div class="content_wrap">
      <h1>會員管理｜感謝函</h1>
      <div class="search">
        <Search :placeholder="'請輸入感謝函資訊'"
        :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>感謝函ID</th>
              <th>兒童ID</th>
              <th>會員ID</th>
              <th>認養訂單ID</th>
              <th>收件日期</th>
              <th>檔名</th>
              <th>狀態</th>
              <th>功能</th>
              <th>更新者</th>
              <th>更新時間</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredLetterList" :key="item.thanks_letter_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>

              <td class="thanks_letter_id">{{ item.thanks_letter_id }}</td>
              <td class="children_id">{{ item.children_id }}</td>
              <td class="member_id">{{ item.member_id }}</td>
              <td class="sponsor_order_id">{{ item.sponsor_order_id }}</td>
              <td class="receive_date">{{ item.receive_date }}</td>
              <td class="thanksletter_img">{{ item.thanksletter_img }}</td>
              <td class="is_read">{{ item.is_read == 1 ? '已讀' : '未讀' }}</td>
              <td>
                <v-switch v-model="item.is_read" color="#EBC483" density="compact" hide-details="true" inline
                inset true-value=1 @change="updateOrderStatus(item)">
                </v-switch>
              </td>
              <td class="updater">{{ item.updater }}</td>
              <td class="update_time">{{ item.update_time }}</td>
              <td class="update_and_delete">
                <UpdateThanksLetter
                :thanksLetterIdForUpdate="parseInt(item.thanks_letter_id)"
                :childrenIdForUpdate="parseInt(item.children_id)"
                :memberIdIdForUpdate="parseInt(item.memberId_id)"
                :sponsorOrderIdForUpdate="parseInt(item.sponsor_order_id)"
                :receiveDateIdForUpdate="parseInt(item.receive_date)"
                />

                <DeleteThanksLetter
                :thanksLetterIdForDelete="parseInt(item.thanks_letter_id)" />
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateThanksLetter class="add" />
      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/member/thanks-letter";
</style>
