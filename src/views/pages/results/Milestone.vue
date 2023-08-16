<script setup>
//【引入】
import Search from '@/components/Search.vue'; //查詢
import CreateMilestone from '@/views/create-dialog/results/CreateMilestone.vue'; //新增里程碑
import UpdateMilestone from '@/views/update-dialog/results/UpdateMilestone.vue'; //編輯里程碑
import DeleteMilestone from '@/views/delete-dialog/results/DeleteMilestone.vue'; //刪除里程碑


import { ref, computed, onMounted } from 'vue'
import axios from 'axios';
import { useMilestoneStore } from '@/stores/results/milestone.js';
const MilestoneStore = useMilestoneStore();


//【串接資料庫】
async function getMilestone() {
  try {
    const response = await axios.post('http://tibamef2e.com/chd102/g3/back-end/php/results/milestone/get_milestone.php');
    MilestoneStore.milestonePool.splice(0);

    if (response.data.length > 0) {
      response.data.forEach(element => {
        MilestoneStore.milestonePool.push(element);
      });
    }
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  getMilestone();
});


// 【換頁功能】
const page = ref(1)
const itemsPerPage = 10;
const pageCount = computed(() => {
  return Math.ceil(MilestoneStore.milestonePool.length / itemsPerPage);
});
const displayMilestoneList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return filteredMilestoneList.value.slice(startIdx, endIdx);
});


//【查詢功能】
const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(searchValue.value);
}

const searchText = computed(() => {
  let searchText = searchValue.value ? searchValue.value.trim() : '';
  if (!isNaN(+searchText)) {
    searchText = +searchText < 10 ? `0${searchText}` : searchText;
  }
  return searchText;
})

const filteredMilestoneList = computed(() => {
  return MilestoneStore.milestonePool.filter((item) => {
    const obj = [item.milestone_id, item.milestone_title, item.milestone_date]
    const str = JSON.stringify(obj);
    return str.includes(searchText.value)
  });
});


//【切換上下架功能】
async function UpdateMilestoneOnlineStatus(item) {
  try {
    if (item.milestone_no == null) {
      throw new Error("milestone no not found!")
    }
    await MilestoneStore.updateMilestoneOnlineStatusBackend(item.milestone_no,item.is_milestone_online)
    MilestoneStore.updateOrderStatusFromMilestoneList(item.milestone_no,item.is_milestone_online)

  } catch (error) {
    console.error(error);
  }
}

</script>


<template>
  <div class="container">
    <div class="content_wrap">
      <h1>成果管理｜服務里程碑</h1>
      <div class="search">
        <Search :placeholder="'請輸入里程碑資訊'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>里程碑ID</th>
              <th>里程碑標題</th>
              <th>年度/月份</th>
              <th>狀態</th>
              <th>功能</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in displayMilestoneList" :key="item.milestone_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>

              <td class="id">{{ item.milestone_id }}</td>
              <td class="title">{{ item.milestone_title }}</td>
              <td class="date">{{ item.milestone_date }}</td>
              <td class="online">{{ item.is_milestone_online == 1 ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.is_milestone_online" color="#EBC483" density="compact" hide-details="true" inline
                  inset true-value=1 @change="UpdateMilestoneOnlineStatus(item)"></v-switch>
              </td>
              <td class="update_and_delete">
                <UpdateMilestone :milestoneNoForUpdate="parseInt(item.milestone_no)" 
                :milestoneTitleForUpdate="item.milestone_title" 
                :milestoneDateForUpdate="item.milestone_date" 
                :milestoneContentForUpdate="item.milestone_content" 
                :milestoneImageForUpdate="item.milestone_image"/>
                
                <DeleteMilestone :milestoneNoForDelete="parseInt(item.milestone_no)" />
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateMilestone class="add" />

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/results/milestone";
</style>
