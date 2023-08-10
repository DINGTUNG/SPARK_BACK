<script setup>
import { ref } from 'vue'
import { useSponsorLocationStore } from '@/stores/sponsor-location.js';
const locationStore = useSponsorLocationStore();
const dialog = ref(false);
const locationContent = ref('')
async function createLocation(locationContent) {
  try {
    const newLocation = await locationStore.createLocationBackend(locationContent)
    addContentToNewLocation(newLocation)
    console.log(locationStore.locationList);
    window.alert(`新增成功!`);
  } catch (error) {
    console.error(error);
    window.alert(`http status : ${error.response.data} 新增失敗!請聯絡管理員!`);
  } finally {
    closeDialog()
  }
}

const addContentToNewLocation = (newLocation) => {
  locationStore.locationList.push(newLocation)
}

</script>

<template>
  <v-row justify="end">
    <v-dialog v-model="dialog" persistent width="50%">
      <template v-slot:activator="{ props }">
        <v-btn color="primary" v-bind="props">
          新增
        </v-btn>
      </template>
      <v-card>
        <form action="http://localhost/SPARK_BACK/php/sponsor/sponsor-location/create_sponsor_location.php" method="post" @submit.prevent="createLocation(locationContent)">
          <v-card-title>
            <span class="text-h5">新增認養據點</span>
          </v-card-title>
          <v-card-text>
            <label for="">據點名稱
              <input type="text">
            </label>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
              取消
            </v-btn>
            <v-btn color="blue-darken-1" variant="text" @click="dialog = false" type="submit">
              確定
            </v-btn>
          </v-card-actions>
        </form>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<style scoped lang="scss">
:deep(.v-btn.v-btn--density-default) {
  background-color: $primaryBrandBlue !important;

}

:deep(.v-dialog > .v-overlay__content) {
  width: 50%;
}

:deep(.v-card.v-theme--light.v-card--density-default.v-card--variant-elevated) {
  height: 50%;
  top: 50%;
}

:deep(.v-btn__content) {
  color: #ffff !important;
}

:deep(.v-card .v-card-title) {
  padding: 20px;
  text-align: center;
}

label {
  @include flex_hm();
}

.text-h5 {
  color: $primaryBrandBlue;
  @include h5_PC;
  font-weight: 900;

}

.imgblock {
  display: flex;

  input[type="file"] {
    border: 1px transparent;
  }


  input {
    height: 5vh;
    padding-left: 10px;
    padding-top: 5px;
    margin-left: 1vw;
    width: 2vw;
    width: 50%;
    border: 1px solid;
    border-radius: $br_MB;
  }

}

input {
  height: 5vh;
  padding-left: 10px;
  padding-top: 5px;
  margin-left: 1vw;
  width: 2vw;
  width: 50%;
  border: 1px solid;
  border-radius: $br_MB;
}

label {
  margin-bottom: 20px;
  display: flex;

  textarea {
    margin-left: 1vw;
    border: 1px solid;
    padding-left: 10px;
    padding-top: 10px;
    border-radius: $br_MB;

  }
}

:deep(.v-btn.v-btn--density-default) {
  background-color: $primaryBrandBlue !important;
  width: 137px;
  height: 55px;
  border-radius: 50px;
  margin-bottom: 50px;
  margin-right: 20px;
}

:deep(.v-btn__content) {
  font-size: 20px;
}
</style>
