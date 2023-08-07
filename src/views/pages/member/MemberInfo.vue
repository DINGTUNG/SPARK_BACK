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
// async function newsConnection() {
//   try {
//     const response = await axios.post('http://localhost/SPARK_BACK/php/news/news.php')
//     console.log(response)
//     if (response.data.length > 0) {
//       response.data.forEach(element => {
//         newsList.push(element)
//       });
//     }
//   } catch (error) {
//     console.error(error);
//   }
// }
// onMounted(() => {
//   newsConnection()
// })
</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>會員管理｜會員資料</h1>
      <div class="search">
        <Search :placeholder="'請輸入會員資訊'" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>會員編號</th>
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
            <tr v-for="(item, index) in displayedMemberInfo" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="td_id">{{ item.news_id }}</td>
              <td class="name">{{ item.news_title }}</td>
              <td class="date">{{ item.news_date }}</td>
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

