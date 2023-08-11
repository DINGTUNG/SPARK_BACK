<script setup>
import Search from '@/components/Search.vue';
import CreateSparkActivity from '@/views/create-dialog/activity/CreateSparkActivity.vue';
import UpdateSparkActivity from '@/views/update-dialog/activity/UpdateSparkActivity.vue';
import DeleteSparkActivity from '@/views/delete-dialog/activity/DeleteSparkActivity.vue';
import { ref, computed, onMounted } from 'vue'
import axios from 'axios';
import { useSparkActivityStore } from '@/stores/activity/spark-activity.js';
const sparkActivityStore = useSparkActivityStore();

async function getData() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/activity/spark-activity/get_spark_activity.php')
    sparkActivityStore.sparkActivityPool.splice(0);

    if (response.data.length > 0) {
      response.data.forEach(element => {
        sparkActivityStore.sparkActivityPool.push(element)

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
  return Math.floor((sparkActivityStore.sparkActivityPool.length - 1) / itemsPerPage) + 1;
}
const displaySparkActivityList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return filteredSparkActivityPool.value.slice(startIdx, endIdx);
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

const filteredSparkActivityPool = computed(() => {
  return sparkActivityStore.sparkActivityPool.filter((item) => {
    const obj = [item.spark_activity_id, item.spark_activity_name]
    const str = JSON.stringify(obj);
    return str.includes(searchText.value)
  });
});
</script>

<template>
  <div class="container">
    <div class="content_wrap">
      <h1>活動管理｜星火活動</h1>
      <div class="search">
        <Search :placeholder="'請輸入留言ID或會員ID'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>星火活動ID</th>
              <th>星火活動名稱</th>
              <th>星火活動描述</th>
              <th>開始時間</th>
              <th>結束時間</th>
              <th>活動狀態</th>
              <th>功能</th>
              <th>創建者</th>
              <th>創建時間</th>
              <th>更新者</th>
              <th>更新時間</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displaySparkActivityList" :key="item.spark_activity_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="spark_activity_id">{{ item.spark_activity_id }}</td>
              <td class="spark_activity_name">{{ item.spark_activity_name }}</td>
              <td class="spark_activity_description">{{ item.spark_activity_description }}</td>
              <td class="spark_activity_start_date">{{ item.spark_activity_start_date }}</td>
              <td class="spark_activity_end_date">{{ item.spark_activity_end_date }}</td>
              <td class="is_spark_activity_online">{{ item.is_spark_activity_online == 1 ? "進行中" : "已結束" }}</td>
              <td>
                <v-switch v-model="item.is_spark_activity_online" color="#EBC483" density="compact" hide-details="true" inline inset
                  true-value=1 @change="updateSparkActivityStatus(item)"></v-switch>
              </td>
              <td class="register">{{ item.register }}</td>
              <td class="regist_time">{{ item.regist_time }}</td>
              <td class="updater">{{ item.updater }}</td>
              <td class="update_time">{{ item.update_time }}</td>
              <td class="update_and_delete">
                <UpdateSparkActivity :messageNoForUpdate="parseInt(item.message_no)"
                  :sparkActivityIdForUpdate="item.spark_activity_id" :messageContentForUpdate="item.message_content"
                  :memberIdForUpdate="item.member_id" />

                <DeleteSparkActivity :messageNoForDelete="parseInt(item.message_no)" />
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateSparkActivity class="add" />
      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount()" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
  </div>  
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/activity/spark-activity";
</style>
