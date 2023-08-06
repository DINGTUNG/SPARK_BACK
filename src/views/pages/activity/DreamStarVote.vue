<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import axios from 'axios';

const dreamStarVoteList = reactive([])

async function getData() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/activity/get_dream_star_vote.php')
    console.log(response)

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
  getData()
})

// 換頁
const page = ref(1)
const itemsPerPage = 10;
const pageCount = () => {
  return Math.floor((dreamStarVoteList.length - 1) / itemsPerPage) + 1;
}
const displayDreamStarVoteList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return dreamStarVoteList.slice(startIdx, endIdx);
});
</script>

<template>
  <div class="container">
    <div class="content_wrap">
      <h1>活動管理｜夢想之星投票</h1>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>IP</th>
              <th>夢想之星編號</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(item, index) in displayDreamStarVoteList" :key="item.vote_ip" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="ip">{{ item.vote_ip }}</td>
              <td class="dream_star_no">{{ item.dream_star_no }}</td>
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
