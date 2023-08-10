<script setup>
import Search from '@/components/Search.vue';
import { ref, reactive, computed,onMounted } from 'vue';
import axios from 'axios';


const page = ref(1)

// 換頁
const pageCount = () => {
  return (MemberInfo.length) / itemsPerPage + 1;
}
// 換頁
const itemsPerPage = 10;
const displayedMemberInfo = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return MemberInfo.slice(startIdx, endIdx);
});


const MemberInfo = reactive([])
async function memberConnection() {
  try {
    const response = await axios.post('http://localhost:8888/member/member_info/member_info.php')
    console.log(response)
    if (response.data.length > 0) {
      response.data.forEach(element => {
        MemberInfo.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}
onMounted(() => {
  memberConnection()
})

// 查詢功能
const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(searchValue.value);
}

const filteredMemberInfo = computed(() => {
  const searchText = searchValue.value ? searchValue.value.trim().toLowerCase() : '';
  return displayedMemberInfo.value.filter(item => {
    const idMatch = item.member_id.toString().includes(searchText);

    if (isNaN(parseInt(searchText))) {
    const nameMatch = item.member_name.toLowerCase().includes(searchText);
    const salutationMatch = item.member_salutation.toString().includes(searchText);
    const accountMatch = item.member_account.toString().includes(searchText);
    const mobileMatch = item.member_mobile.toString().includes(searchText);
    //確保member_home_phone是空值時，不會觸發錯誤
    const homePhoneMatch = item.member_home_phone?.toString().includes(searchText);
    //確保member_business_phone是空值時，不會觸發錯誤
    const businessPhoneMatch = item.member_business_phone?.toString().includes(searchText);
    const addressMatch = item.member_address.toString().includes(searchText);
    const receiptClassMatch = item.receipt_class.toString().includes(searchText);
    const indexMatch = ((page.value - 1) * itemsPerPage) + displayedMemberInfo.value.indexOf(item) + 1 === parseInt(searchText);
    return idMatch || nameMatch || salutationMatch || accountMatch || mobileMatch || homePhoneMatch || businessPhoneMatch || addressMatch || receiptClassMatch || indexMatch;
    }else {
      return idMatch;
    }
  });
});

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>會員管理｜會員資料</h1>
      <div class="search">
        <Search :placeholder="'請輸入會員資訊'"
        :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>會員編號</th>
              <th>會員ID</th>
              <th>姓名</th>
              <th>稱謂</th>
              <th>帳號</th>
              <th>手機</th>
              <th>住家電話</th>
              <th>公司電話</th>
              <th>住址</th>
              <th>發票種類</th>           
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredMemberInfo" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="no">{{ item.member_no }}</td>
              <td class="id">{{ item.member_id }}</td>
              <td class="name">{{ item.member_name }}</td>
              <td class="salutation">{{ item.member_salutation }}</td>
              <td class="account">{{ item.member_account }}</td>
              <td class="mobile">{{ item.member_mobile }}</td>
              <td class="home_phone">{{ item.member_home_phone }}</td>
              <td class="business_phone">{{ item.member_business_phone }}</td>
              <td class="address">{{ item.member_address }}</td>
              <td class="receipt_class">{{ item.receipt_class }}</td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length=pageCount() rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/member/member-info";
</style>

