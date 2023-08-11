<script setup>
import { ref,defineProps } from 'vue'
import { useSponsorLocationStore } from '@/stores/sponsor/sponsor-location.js';
const locationStore = useSponsorLocationStore();
const dialog = ref(false);
const vueProps = defineProps({
  locationNoForUpdate: String
})
const locationNewName=ref('')

function showDialog() {
  locationNewName.value = vueProps.locationNoForUpdate
}

async function updateLocation(locationNoForUpdate,locationNewName) {
  try {
    if (locationNoForUpdate == null) {
      throw new Error("location no. not found!")
    }
    await locationStore.updateLocationBackend(locationNoForUpdate,locationNewName)
    locationStore.updateLocationFromLocationList(locationNoForUpdate, locationNewName)
    window.alert(`編輯成功!`);
  } catch (error) {
    console.error(error);
    window.alert(`http status : ${error.response.data} 編輯失敗!請聯絡管理員!`);
  } finally {
    closeDialog()
  }
}
</script>
<template>
  <v-row class="row" style="flex: 0;">
    <v-dialog v-model="dialog" persistent width="50%">
      <template v-slot:activator="{ props }">
        <v-icon size="small" class="me-2 icon" v-bind="props" @click="showDialog">mdi-pencil</v-icon>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">編輯地區資料</span>
        </v-card-title>
        <v-card-text>
          <form action="http://localhost/SPARK_BACK/php/sponsor/sponsor-location/update_sponsor_location.php" method="post"  @submit.prevent="updateLocation(vueProps.locationNoForUpdate,locationNewName)">
            <label for="local">編輯地區內容
              <input type="text" name="local" v-model="locationNewName">
            </label>
          </form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
            取消
          </v-btn>
          <v-btn color="blue-darken-1" variant="text" @click="dialog = false" type="submit">
            儲存
          </v-btn>
        </v-card-actions>
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
  font-size: 20px;
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
}

:deep(.v-btn.v-btn--density-default) {
  background-color: $primaryBrandBlue !important;
  width: 137px;
  height: 55px;
  border-radius: 50px;
  margin-bottom: 50px;
  margin-right: 20px;
}

</style>