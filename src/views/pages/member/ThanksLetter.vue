<script setup>
import Search from '@/components/Search.vue';
// import CreateMessagePractice from '@/views/create-dialog/CreateMessagePractice.vue';
// import UpdateMessagePractice from '@/views/update-dialog/UpdateMessagePractice.vue';
// import DeleteMessage from '@/views/delete-dialog/DeleteMessage.vue';

import { ref, reactive, computed, onMounted }  from 'vue'
import axios from 'axios';

// import { useMessageBoardStore } from '@/stores/message-board.js';
// const messageBoardStore = useMessageBoardStore();


//串接資料庫
const LetterList = reactive([])
async function getData() {
  try {
    const response = await axios.post('http://localhost:8888/member/thanks_letter/thanks_letter.php')

    if (response.data.length > 0) {
      response.data.forEach(element => {
        LetterList.push(element)
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
const pageCount = () => {
  return (LetterList.length) / itemsPerPage + 1;
}
const itemsPerPage = 10;
const displayLetterList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return LetterList.slice(startIdx, endIdx);
});

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
      const index = staffList.indexOf(itemToDelete.value);
      if (index !== -1) {
        staffList.splice(index, 1); // 從列表中刪除項目
      }
    }
    itemToDelete.value = null; // 清空要刪除的項目
  }
}


// 查詢功能
// const searchValue = ref('');
// function handleSearchChange(newValue) {
//   searchValue.value = newValue;
//   console.log(searchValue.value);
// }

// const filteredMemberInfo = computed(() => {
//   const searchText = searchValue.value ? searchValue.value.trim().toLowerCase() : '';
//   return displayedMemberInfo.value.filter(item => {
//     const idMatch = item.member_id.toString().includes(searchText);

//     if (isNaN(parseInt(searchText))) {
//     const nameMatch = item.member_name.toLowerCase().includes(searchText);
//     const salutationMatch = item.member_salutation.toString().includes(searchText);
//     const accountMatch = item.member_account.toString().includes(searchText);
//     const mobileMatch = item.member_mobile.toString().includes(searchText);
//     //確保member_home_phone是空值時，不會觸發錯誤
//     const homePhoneMatch = item.member_home_phone?.toString().includes(searchText);
//     //確保member_business_phone是空值時，不會觸發錯誤
//     const businessPhoneMatch = item.member_business_phone?.toString().includes(searchText);
//     const addressMatch = item.member_address.toString().includes(searchText);
//     const receiptClassMatch = item.receipt_class.toString().includes(searchText);
//     const indexMatch = ((page.value - 1) * itemsPerPage) + displayedMemberInfo.value.indexOf(item) + 1 === parseInt(searchText);
//     return idMatch || nameMatch || salutationMatch || accountMatch || mobileMatch || homePhoneMatch || businessPhoneMatch || addressMatch || receiptClassMatch || indexMatch;
//     }else {
//       return idMatch;
//     }
//   });
// });

</script>

<template>
  <div class="container">
    <div class="content_wrap">
      <h1>會員管理｜感謝函</h1>
      <div class="search">
        <Search :placeholder="'請輸入感謝函ID'"
        :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>感謝函編號</th>
              <th>感謝函ID</th>
              <th>會員ID</th>
              <th>認養訂單ID</th>
              <th>收件日期</th>
              <th>圖檔</th>
              <th>狀態</th>
              <th>功能</th>
              <th>更新者</th>
              <th>更新時間</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayLetterList" :key="item.thanks_letter_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>

              <td class="thanks_letter_no">{{ item.thanks_letter_no }}</td>
              <td class="thanks_letter_id">{{ item.thanks_letter_id }}</td>
              <td class="member_id">{{ item.member_id }}</td>
              <td class="sponsor_order_id">{{ item.sponsor_order_id }}</td>
              <td class="receive_date">{{ item.receive_date }}</td>
              <td class="file_name">{{ item.file_name }}</td>
              <td class="is_read">{{ item.is_read ? '未讀' : '已讀' }}</td>
              <td>
                <v-switch v-model="item.is_read" color="#EBC483" density="compact" hide-details="true" inline
                  inset></v-switch>
              </td>
              <td class="updater">{{ item.updater }}</td>
              <td class="update_time">{{ item.update_time }}</td>
              <td class="update_and_delete">
                <UpdateMessagePractice 
                :messageNoForUpdate="parseInt(item.message_no)"
                :sparkActivityNoForUpdate="parseInt(item.spark_activity_no)" 
                :messageContentForUpdate="item.message_content"
                :memberNoForUpdate="parseInt(item.member_no)" />

                <DeleteMessage :messageNoForDelete="parseInt(item.message_no)" />
              </td>
              <!-- <td class="update_and_delete">
                <UpdateLocation />
                <v-icon size="small" @click="showDeleteDialog(item)">mdi-delete</v-icon>
              </td> -->
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateMessagePractice class="add" />
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
