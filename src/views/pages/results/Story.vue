<script setup>
import PopUpStory from '@/views/pop-ups/popUpStory.vue';
import { ref, reactive,computed } from 'vue'
const dialogDelete = ref(false);
const page = ref(1)

let storyList = reactive([])

  fetch('http://localhost/SPARK_BACK/php/results/story/read_story.php')
    .then(res => res.json())
    .then(data => {
      storyList.value = data.stories
    })
    .catch(err => console.log(err))
  
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

const switchOnline = (no, online) => {
  console.log(no, online);
  window.location.assign(`http://localhost/SPARK_BACK/php/results/story/upload_story.php?story_no=${no}&is_story_online=${online}`)
}

let deleteId = ref(null)
const showDeleteDialog = (no) => {
  dialogDelete.value = true
  deleteId = no
}
const closeDelete = () => {
  dialogDelete.value = false
}
const deleteItemConfirm = () => {
  window.location.assign(`http://localhost/SPARK_BACK/php/results/story/delete_story.php?story_no=${deleteId}`)
}
    


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
              <v-icon size="small" class="me-2" @click="editItem(item.raw)">
                mdi-pencil
              </v-icon>
              <v-icon size="small" @click="showDeleteDialog(item.story_no)">mdi-delete</v-icon>
            </td>
          </tr>
        </tbody>

      </v-table>
    </div>
    <PopUpStory class="add" />

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length=pageCount() rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>

    <v-dialog v-model="dialogDelete" max-width="800px" persistent>

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




  </div>
</template>

<style scoped lang="scss">
@import "@/assets/sass/pages/results/story";
</style>
