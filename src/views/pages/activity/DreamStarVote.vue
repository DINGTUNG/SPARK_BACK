<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';

const dreamStarVoteList = reactive([])

async function testConnection() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/activity/dream_star_vote.php')

    if (response.data.length > 0) {
      response.data.forEach(element => {
        dreamStarVoteList.push(element)
      });
    }
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  testConnection()
})


const page = ref(1)

// 換頁
const itemsPerPage = 10;
const pageCount = () => {
  console.log("狸貓",Math.floor((dreamStarVoteList.length - 1) / itemsPerPage) + 1);
  return Math.floor((dreamStarVoteList.length - 1) / itemsPerPage) + 1;
}


// const displayDreamStarVoteList = computed(() => {
//   const startIdx = (page.value - 1) * itemsPerPage;
//   const endIdx = startIdx + itemsPerPage;
//   return dreamStarVoteList.slice(startIdx, endIdx);
// });


</script>


<template>
  <div class="container">
    <button @click="testConnection">testConnection</button>
    <div class="content_wrap">
      <h1>活動管理｜夢想之星投票</h1>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>IP</th>
              <th>星火活動編號</th>
              <th>星火活動名稱</th>
              <th>夢想之星編號</th>
              <th>夢想之星名稱</th>

            </tr>
          </thead>

          <tbody>
            <tr v-for="(item, index) in dreamStarVoteList" :key="item.vote_ip" class="no-border">
              <!-- <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td> -->
              <td class="ip">{{ item.vote_ip }}</td>
              <td class="ip">{{ item.dream_star_no }}</td>

              <!-- <td class="sparkActivityNo">{{ item.sparkActivityNo }}</td>
              <td class="sparkActivityName">{{ item.sparkActivityName }}</td>
              <td class="dreamStarNo">{{ item.dreamStarNo }}</td>
              <td class="dreamStarName">{{ item.dreamStarName }}</td> -->

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
@import "@/assets/sass/pages/activity/dream-star-vote";
</style>
