<script setup>
import { ref, reactive, computed } from 'vue'



const page = ref(1)

// 換頁
const itemsPerPage = 10;
const pageCount = () => {
  return (dreamStarVoteList.length) / itemsPerPage + 1;
}
const displayDreamStarVoteList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return dreamStarVoteList.slice(startIdx, endIdx);
});


const dreamStarVoteList = reactive([
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },
  {
    ip: '8.787.128.228',
    sparkActivityNo: 'SA001',
    sparkActivityName: '第一屆圓夢之旅',
    dreamStarNo: 'DS001',
    dreamStarName: '美食大師-烹飪歷險記',
  },

])

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
              <th>星火活動編號</th>
              <th>星火活動名稱</th>
              <th>夢想之星編號</th>
              <th>夢想之星名稱</th>

            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayDreamStarVoteList" :key="item.id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="ip">{{ item.ip }}</td>
              <td class="sparkActivityNo">{{ item.sparkActivityNo }}</td>
              <td class="sparkActivityName">{{ item.sparkActivityName }}</td>
              <td class="dreamStarNo">{{ item.dreamStarNo }}</td>
              <td class="dreamStarName">{{ item.dreamStarName }}</td>

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
