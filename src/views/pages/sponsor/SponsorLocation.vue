<script setup>
import CreateLocation from '@/views/create-dialog/CreateLocation.vue';
import UpdateLocation from '@/views/update-dialog/UpdateLocation.vue';
import DeleteLocation from '@/views/delete-dialog/DeleteLocation.vue';
import Search from '@/components/Search.vue';
import { ref, reactive, computed, onMounted } from 'vue';
import axios from 'axios';
import { useSponsorLocationStore } from '@/stores/sponsor-location.js';
const locationStore = useSponsorLocationStore();
const page = ref(1);
const dialogDelete = ref(false);
const itemToDelete = ref(null);

function showDeleteDialog(item) {
  itemToDelete.value = item;
  dialogDelete.value = true;
}

function deleteItemConfirm() {
  if (itemToDelete.value) {
    const index = locationList.indexOf(itemToDelete.value);
    if (index !== -1) {
      locationList.splice(index, 1);
    }
    itemToDelete.value = null;
    dialogDelete.value = false;
  }
}

function closeDelete() {
  dialogDelete.value = false;
}

async function getSponsorLocation() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/sponsor/sponsor-location/get_sponsor_location.php');
    if (response.data.length > 0) {
      response.data.forEach(element => {
        locationStore.locationList.push(element);
      });
    }
  } catch (error) {
    console.error(error);
  }
}

onMounted(() => {
  getSponsorLocation();
});

const itemsPerPage = 10;
const pageCount = computed(() => {
  return Math.ceil(locationStore.locationList.length / itemsPerPage);
});
const displayLocationList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return locationStore.locationList.slice(startIdx, endIdx);
});

const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
  console.log(searchValue.value);
}

const filteredLocationList = computed(() => {
  const searchText = searchValue.value ? searchValue.value.trim().toLowerCase() : '';
  return displayLocationList.value.filter(item => {
    const idMatch = item.location_id.toString().includes(searchText);
    if (isNaN(parseInt(searchText))) {
      const nameMatch = item.location_name.toLowerCase().includes(searchText);
      const onlineStatusMatch = ((item.is_milestone_online && '已上架'.includes(searchText)) || (!item.is_milestone_online && '未上架'.includes(searchText)));
      const indexMatch = ((page.value - 1) * itemsPerPage) + displayLocationList.value.indexOf(item) + 1 === parseInt(searchText);
      return idMatch || nameMatch || onlineStatusMatch || indexMatch;
    } else {
      return idMatch;
    }
  });
});

</script>

<template>
  <div class="container">
    <div class="content_wrap">
      <h1>認養管理｜認養據點</h1>
      <div class="search">
        <Search :placeholder="'請輸入據點資訊'" :search-value="searchValue" @search="handleSearchChange" />
      </div>
      <div class="table_container">
        <v-table>
          <thead>
            <tr>
              <th>No.</th>
              <th>據點ID</th>
              <th>據點名稱</th>
              <th>狀態</th>
              <th>功能</th>
              <th>更新者</th>
              <th>更新時間</th>
              <th>刪改</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in filteredLocationList" :key="item.location_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.location_id }}</td>
              <td class="name">{{ item.location_name }}</td>
              <td class="online">{{ item.is_sponsor_location_online == 1 ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.is_sponsor_location_online" color="#EBC483" density="compact" hide-details="true"
                  inline inset true-value=1></v-switch>
              </td>
              <td class="year">{{ item.updater }}</td>
              <td class="name">{{ item.update_time }}</td>
              <td class="update_and_delete">
                <UpdateLocation />
                <DeleteLocation :locationNoForDelete="parseInt(item.location_no)"/>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <CreateLocation class="add" />
      <div class="text-center">
        <v-pagination v-model="page" :length="pageCount" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
@import "@/assets/sass/pages/sponsor/sponsor-location";
</style>
