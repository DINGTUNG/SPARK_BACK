<script setup>
import Search from '@/components/Search.vue';
import CreateThanksLetter from '@/views/create-dialog/member/CreateThanksLetter.vue';
import UpdateThanksLetter from '@/views/update-dialog/member/UpdateThanksLetter.vue';
import DeleteThanksLetter from '@/views/delete-dialog/member/DeleteThanksLetter.vue';

import { ref, computed , onMounted }  from 'vue'
import axios from 'axios';
import { useThanksLetterStore } from '@/stores/member/thanks-letter.js';
const thanksLetterStore = useThanksLetterStore();


//串接資料庫
async function getThanksLetter() {
  try {
    const response = await axios.post('https://tibamef2e.com/chd102/g3/back-end/php/member/thanks-letter/get_thanks_letter.php')
    // const response = await axios.post('http://localhost:8888/member/thanks-letter/thanks_letter.php')
    thanksLetterStore.thanksLetterPool.splice(0);
    if (response.data.length > 0) {
      response.data.forEach(element => {
        thanksLetterStore.thanksLetterPool.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  getThanksLetter()
});


// update sent status
async function updateThanksLetterSentStatus(item) {
  try {
    if (item.thanks_letter_no == null) {
      throw new Error("thanks_letter_no not found!")
    }
    await thanksLetterStore.updateThanksLetterSentStatusBackend(item.thanks_letter_no,item.is_thanks_letter_sent)
    thanksLetterStore.updateSentStatusFromThanksLetterPool(item.thanks_letter_no,item.is_thanks_letter_sent)

  } catch (error) {
    console.error(error);
  }
}


// 換頁
const pageCount = () => {
  return Math.ceil(filteredLetterList.value.length / itemsPerPage);
}
const page = ref(1)
const itemsPerPage = 10;
const displayLetterList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return filteredLetterList.value.slice(startIdx, endIdx);
});


//查詢功能
const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(newValue);
};

const searchText = computed(() => {
  let searchText = searchValue.value ? searchValue.value.trim() : '';
  if (!isNaN(+searchText)) {
    searchText = +searchText < 10 ? `0${searchText}` : searchText;
  }
  return searchText;
})

const filteredLetterList = computed(() => {
  return thanksLetterStore.thanksLetterPool.filter((item) => {
    const obj = [item.thanks_letter_id, item.children_id, item.member_id, item.sponsor_order_id ]
    const str = JSON.stringify(obj);
    return str.includes(searchText.value)
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
            <tr v-for="(item, index) in displayLetterList" :key="item.thanks_letter_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="thanks_letter_id">{{ item.thanks_letter_id }}</td>
              <td class="children_id">{{ item.children_id }}</td>
              <td class="member_id">{{ item.member_id }}</td>
              <td class="sponsor_order_id">{{ item.sponsor_order_id }}</td>
              <td class="receive_date">{{ item.receive_date }}</td>
              <td class="file_name">{{ item.thanks_letter_file }}</td>
              <td class="is_thanks_letter_sent">
                {{ item.is_thanks_letter_sent == 1 ? '已寄出' : '待確認' }}</td>
              <td>
                <v-switch v-model="item.is_thanks_letter_sent" color="#EBC483" density="compact" hide-details="true" inline
                inset true-value=1 @change="updateThanksLetterSentStatus(item)">
                </v-switch>
              </td>
              <td class="updater">{{ item.updater }}</td>
              <td class="update_time">{{ item.update_time }}</td>
              <td class="update_and_delete">
                <UpdateThanksLetter
                :thanksLetterNoForUpdate="parseInt(item.thanks_letter_no)"
                :childrenIdForUpdate="item.children_id"
                :memberIdForUpdate="item.member_id"
                :sponsorOrderIdForUpdate="item.sponsor_order_id"
                :receiveDateForUpdate="item.receive_date"
                :thanksLetterFileForUpdate="item.thanks_letter_file"
                />

                <DeleteThanksLetter
                :thanksLetterNoForDelete="parseInt(item.thanks_letter_no)" />
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
