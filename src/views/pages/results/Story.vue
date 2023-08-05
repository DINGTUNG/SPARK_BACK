<script setup>
import popUpStory from '@/views/pop-ups/popUpStory.vue';
import { ref, reactive,computed  } from 'vue'
const page = ref(1)
const pageCount = () => {
  return (storyList.length) / itemsPerPage + 1;
}
const itemsPerPage = 10;

fetch('http://localhost/SPARK_BACK/php/results/story.php')
  .then(res => res.clone().json())
  .then(data => showStory(data))
  .catch(err => console.log(err));

let storyList = reactive([])
const showStory = (data) => {
  storyList = data.stories  
}


// const displayStoryList = computed(() => {
//   const startIdx = (page.value - 1) * itemsPerPage;
//   const endIdx = startIdx + itemsPerPage;
//   return storyList.slice(startIdx, endIdx);
// });




</script>


<template>
  <a href=""></a>
  <div class="container">
    <div class="content_wrap">
      <h1>成果管理｜溫馨事紀</h1>
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
          <tr v-for="(item, index) in storyList" :key="item.story_no" class="no-border">
            <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
            <td class="id">{{ item.story_no }}</td>
            <td class="name">{{ item.story_title }}</td>
            <td class="start_date">{{ item.story_date }}</td>
            <td class="online">{{ item.is_story_online ? '已上架' : '未上架' }}</td>
            <td>
              <v-switch v-model="item.is_story_online" color="#EBC483" density="compact" hide-details="true" inline
                inset></v-switch>
            </td>
            <td>
              <v-icon size="small" class="me-2" @click="editItem(item.raw)">
                mdi-pencil
              </v-icon>
              <v-icon size="small" @click="showDeleteDialog(item.raw)">mdi-delete</v-icon>
            </td>
          </tr>
        </tbody>
      </v-table>
    </div>
    <PopUpStory class="add" />

      <!-- 分頁 -->
      <!-- <div class="text-center">
        <v-pagination v-model="page" :length=pageCount() rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div> -->
    </div>

    <v-dialog v-model="dialogDelete" max-width="800px" persistent="true">

      <v-card class="delete_dialog">
        <v-card-title class="text-center">
          確定是否要刪除此捐款專案？
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="#F2DFBF" variant="text" @click="closeDelete">
            取消
          </v-btn>
          <v-btn color="#F2DFBF" variant="text" @click="deleteItemConfirm">
            刪除
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <popUpStory/>




  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/results/story";
</style>
