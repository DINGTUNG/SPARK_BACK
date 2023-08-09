<script setup>
import CreateStory from '@/views/create-dialog/CreateStory.vue';
import UpdateStory from '@/views/update-dialog/UpdateStory.vue';
import DeleteStory from '@/views/delete-dialog/DeleteStory.vue';
import axios from 'axios';
import { ref, reactive,computed, onMounted } from 'vue'
const page = ref(1)


const storyList = reactive([])
async function getData() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/results/story/read_story.php')
    if(response.data.stories.length > 0) {
      storyList.value = response.data.stories
    }
  } catch (error) {
    console.error(error);
  }
}
onMounted(() => {
  getData()
})

    
  //分頁
    const itemsPerPage = 10;
    const displayStoryList = computed(() => {
      if (storyList.value) {
        const startIdx = (page.value - 1) * itemsPerPage;
        const endIdx = startIdx + itemsPerPage;
        return reactive(storyList.value.slice(startIdx, endIdx));
      } else {
        return reactive([]);
      }
    });

    const pageCount = () => {
      return (displayStoryList.length) / itemsPerPage + 1;
    };

//切換上下架狀態
const onlineCount = ref(0) 
const sumOnlineCount = () => {
   onlineCount.value = storyList.value.filter(item => item.is_story_online == 1).length
  }

const switchOnline =  ( no, online ) => {
    sumOnlineCount()
    if (onlineCount.value >= 18 && online == 0) {  
      alert('上架數量已達上限(18篇)')
    } 
      window.location.assign(`http://localhost/SPARK_BACK/php/results/story/upload_story.php?story_no=${no}&is_story_online=${online}`)
}



</script>


<template>
  <a href=""></a>
  <div class="container">
    <div class="content_wrap">
      <h1 @click="show()">成果管理｜溫馨事紀</h1>
      <div class="table_container">
        <v-table>
        <thead>
          <tr>
            <th>No.</th>
            <th>事紀編號</th>
            <th>事紀標題</th>
            <th>事紀日期</th>
            <th>狀態</th>
            <th>功能</th>
            <th>刪改</th>
          </tr>
        </thead>
        <tbody>  
          <tr v-for="(item, index) in displayStoryList" :key="index" class="no-border">
            <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
            <td class="id">{{ item.story_id }}</td>
            <td class="name">{{ item.story_title }}</td>
            <td class="start_date">{{ item.story_date }}</td>
            <td class="online">{{ item.is_story_online==1 ? '已上架' : '未上架' }}</td>
            <td>
              <v-switch @click="switchOnline(item.story_no, item.is_story_online)" v-model="item.is_story_online" color="#EBC483" density="compact" hide-details="true" inline inset
                  true-value=1></v-switch>
            </td>
            <td>
              <UpdateStory :storyNo="item.story_no" style="display: inline-block;" />
              <DeleteStory :storyNo="item.story_no" style="display: inline-block;" />
            </td>
          </tr>
        </tbody>

      </v-table>
    </div>
    <CreateStory class="add" />
      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length=pageCount() rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/results/story";
</style>
