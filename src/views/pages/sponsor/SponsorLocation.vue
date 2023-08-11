<script setup>
import CreateLocation from '@/views/create-dialog/sponsor/CreateLocation.vue';
import UpdateLocation from '@/views/update-dialog/sponsor/UpdateLocation.vue';
import DeleteLocation from '@/views/delete-dialog/sponsor/DeleteLocation.vue';
import Search from '@/components/Search.vue';
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { useSponsorLocationStore } from '@/stores/sponsor/sponsor-location.js';
const locationStore = useSponsorLocationStore();
//api
async function getSponsorLocation() {
  try {
    const response = await axios.post('http://localhost/SPARK_BACK/php/sponsor/sponsor-location/get_sponsor_location.php');
    locationStore.locationList.splice(0);
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

//分頁
const page = ref(1);
const itemsPerPage = 10;
const pageCount = computed(() => {
  return Math.ceil(locationStore.locationList.length / itemsPerPage);
});
const displayLocationList = computed(() => {
  const startIdx = (page.value - 1) * itemsPerPage;
  const endIdx = startIdx + itemsPerPage;
  return filteredLocationList.value.slice(startIdx, endIdx);
});


//搜索
const searchValue = ref('');
function handleSearchChange(newValue) {
  searchValue.value = newValue;
}

const searchText = computed(() => {
  let searchText = searchValue.value ? searchValue.value.trim().toUpperCase() : '';
  if (!isNaN(+searchText)) {
    searchText = +searchText < 10 ? `0${searchText}`: searchText;
  }
  return searchText;
})

const filteredLocationList = computed(() => {
  return locationStore.locationList.filter((item) => { 
    const obj = [item.location_id, item.location_name]
    const str = JSON.stringify(obj);
    return str.includes(searchText.value)
  });
});

//上下架
async function UpdateLocationOnline(item) {
  try {
    if (item.location_no == null) {
      throw new Error("location no not found!")
    }
    await locationStore.updateLocationOnlineBackend(item.location_no,item.is_sponsor_location_online)
    locationStore.updateOrderStatusFromLocationList(item.location_no,item.is_sponsor_location_online)

    // console.log(item.is_sponsor_location_online);

  } catch (error) {
    console.error(error);
  }
}


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
            <tr v-for="(item, index) in displayLocationList" :key="item.location_id" class="no-border">
              <td class="td_no">{{ ((page - 1) * itemsPerPage) + index + 1 }}</td>
              <td class="id">{{ item.location_id }}</td>
              <td class="name">{{ item.location_name }}</td>
              <td class="online">{{ item.is_sponsor_location_online == 1 ? '已上架' : '未上架' }}</td>
              <td>
                <v-switch v-model="item.is_sponsor_location_online" color="#EBC483" density="compact" hide-details="true"
                  inline inset true-value=1 @change="UpdateLocationOnline(item)">
                </v-switch>
              </td>
              <td class="year">{{ item.updater }}</td>
              <td class="name">{{ item.update_time }}</td>
              <td class="update_and_delete">
                <UpdateLocation :locationNoForUpdate="parseInt(item.location_no)" :locationNameForUpdate="item.location_name" />                
                <DeleteLocation :locationNoForDelete="parseInt(item.location_no)" />
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
