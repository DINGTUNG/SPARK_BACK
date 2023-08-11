<script setup>
import CreateNews from '@/views/create-dialog/news/CreateNews.vue';
import UpdateNews from '@/views/update-dialog/news/UpdateNews.vue';
import DeleteNews from '@/views/delete-dialog/news/DeleteNews.vue';
import Search from '@/components/Search.vue';
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

import { useNewsStore } from '@/stores/news/news.js';
const newsStore = useNewsStore();

async function getData() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/news/get_news.php')
    if (response.data.length > 0) {
      response.data.forEach(element => {
        newsStore.newsPool.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  getData()
})


const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(newValue);
};

const searchText = computed(() => {
  let searchText = searchValue.value ? searchValue.value.trim().toUpperCase() : '';
  if (!isNaN(+searchText)) {
    searchText = +searchText < 10 ? `0${searchText}`: searchText;
  }
  return searchText;
})

const filteredNewsList = computed(() => {
  return newsStore.newsPool.filter((item) => { 
    const obj = [item.news_id, item.news_title]
    const str = JSON.stringify(obj);
    return str.includes(searchText.value)
  });
});

const pageCount = () => {
  return Math.ceil(filteredNewsList.value.length / itemsPerPage);
}

const page = ref(1)
const itemsPerPage = 10;

const displayNewsList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return filteredNewsList.value.slice(startIdx, endIdx);
});


</script>
<template>
  <div class="container">
    <div class="content_wrap">
      <h1>最新消息</h1>
      <div class="search">
        <Search :placeholder="'請輸入消息資訊'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>消息編號</th>
              <th>消息ID</th>
              <th>標題</th>
              <th>日期</th>
              <th>狀態</th>
              <th>功能</th>
              <th>創建者</th>
              <th>創建時間</th>
              <th>更新者</th>
              <th>更新時間</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayNewsList" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="news_no">{{ item.news_no }}</td>
              <td class="news_id">{{ item.news_id }}</td>
              <td class="news_title">{{ item.news_title }}</td>
              <td class="news_date">{{ item.news_date }}</td>
              <td class="is_news_online">{{ item.is_news_online == 1 ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.is_news_online" color="#EBC483" density="compact" hide-details="true" inline inset
                  true-value=1></v-switch>
              </td>
              <td class="">{{ item.register }}</td>
              <td class="">{{ item.regist_time }}</td>
              <td class="">{{ item.updater }}</td>
              <td class="">{{ item.update_time }}</td>
              <td class="update_and_delete">
                <UpdateNews :newsNoForUpdate="parseInt(item.news_no)" />
                <DeleteNews :newsNoForDelete="parseInt(item.news_no)"/>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateNews class="add" />
      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length=pageCount() rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/news/news";
</style>
