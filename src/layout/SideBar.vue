<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
const router = useRouter();

const open = ref(['Member']);

const memberGroup = ref('Member');
const memberItem = reactive(
  [
    {
      id: "member-info",
      name: "會員"
    },
    {
      id: "thanks-letter",
      name: "感謝函"
    }
  ]
)
const newsGroup = ref('News')
const newsItem = reactive(
  [
    {
      id: "news",
      name: "消息管理"
    }
  ])

const sponsorGroup = ref('Sponsor');
const sponsorItem = reactive(
  [
    {
      id: "sponsor-location",
      name: "認養據點"
    },
    {
      id: "sponsor-order",
      name: "認養訂單"
    }
  ]
)
const donationGroup = ref('Donation');
const donationItem = reactive(
  [
    {
      id: "donate-project",
      name: "捐款專案"
    },
    {
      id: "donate-order",
      name: "捐款訂單"
    }
  ]
)

const activityGroup = ref('Activity');
const activityItem = reactive(
  [
    {
      id: "spark-activity",
      name: "星火活動"
    },
    {
      id: "dream-star",
      name: "夢想之星"
    },
    {
      id: "dream-star-vote",
      name: "夢想之星投票"
    },
    {
      id: "message-board",
      name: "星火活動留言"
    }
  ]
)

const resultGroup = ref('Result');
const resultItem = reactive(
  [
    {
      id: "story",
      name: "溫馨事紀"
    },
    {
      id: "report",
      name: "歷年報告"
    },
    {
      id: "milestone",
      name: "服務里程碑"
    }
  ]
)

const backstageGroup = ref('Backstage');
const backstageItem = reactive(
  [{
    id: "cms-staff",
    name: "後台人員"
  }
  ])

const staffName = ref('');
const getStaffInfo = async () => {
  try{
    const res = await axios.get('https://tibamef2e.com/chd102/g3/back-end/php/backstage_management/get_staff_info.php', { withCredentials: true });
    console.log(res.data);
    staffName.value = res.data.staff_name;
  } catch(error) {
    console.error('網路請求錯誤:', error);
    alert('網路請求錯誤');
  }
}
onMounted(() => {
    getStaffInfo();
})

const handleLogout = async () => {
  try{
    const res = await axios.get('https://tibamef2e.com/chd102/g3/back-end/php/backstage_management/handle_logout.php', { withCredentials: true });
    console.log(res.data);
    router.push({ path: '/' });
  } catch(error) {
    console.error('網路請求錯誤:', error);
    alert('網路請求錯誤');
  }
}
</script>

<template>
  <v-card class="side_bar_container">
    <v-layout>
      <v-navigation-drawer class="side_bar" style="width: 15vw;height: 100vh;">
        <div class="logo">
          <img :src="'pictures/logo/logo_white.svg'" alt="星火logo" @click="router.push({
            path: '/home'
          })">
        </div>
        <v-list :v-model="open" density="compact" style="padding-top: 10vh;padding-bottom: 0;">
          <v-list-group class="title mt-1 mb-1" :value="memberGroup">
            <template v-slot:activator="{ props }">
              <v-list-item v-bind="props" title="會員管理">
                <v-icon icon="mdi-chevron-down" color="#1D3D6C" size="large"></v-icon>
              </v-list-item>
            </template>
            <v-list-item v-for="item in memberItem" :key="item.id" :value="item.id" :title="item.name"
              @click="router.push({ path: '/' + item.id })"></v-list-item>
          </v-list-group>

          <v-list-group class="title  mt-1" :value="newsGroup">
            <template v-slot:activator="{ props }">
              <v-list-item v-bind="props" v-for="item in newsItem" :key="item.id" :value="item.id" :title="item.name"
                @click="router.push({ path: '/' + item.id })">
                <v-icon></v-icon>

              </v-list-item>
            </template>
          </v-list-group>

          <v-list-group class="title  mt-1" :value="sponsorGroup">
            <template v-slot:activator="{ props }">
              <v-list-item v-bind="props" title="認養管理">
                <v-icon icon="mdi-chevron-down" color="#1D3D6C" size="large"></v-icon>
              </v-list-item>
            </template>
            <v-list-item v-for="item in sponsorItem" :key="item.id" :value="item.id" :title="item.name"
              @click="router.push({ path: '/' + item.id })"></v-list-item>
          </v-list-group>

          <v-list-group class="title mt-1" :value="donationGroup">
            <template v-slot:activator="{ props }">
              <v-list-item v-bind="props" title="捐款管理">
                <v-icon icon="mdi-chevron-down" color="#1D3D6C" size="large"></v-icon>
              </v-list-item>
            </template>

            <v-list-item v-for="item in donationItem" :key="item.id" :value="item.id" :title="item.name"
              @click="router.push({ path: '/' + item.id })">
            </v-list-item>

          </v-list-group>

          <v-list-group class=" title mt-1" :value="activityGroup">
            <template v-slot:activator="{ props }">
              <v-list-item v-bind="props" title="活動管理">
                <v-icon icon="mdi-chevron-down" color="#1D3D6C" size="large"></v-icon>
              </v-list-item>
            </template>
            <v-list-item v-for="item in activityItem" :key="item.id" :value="item.id" :title="item.name"
              @click="router.push({ path: '/' + item.id })"></v-list-item>
          </v-list-group>

          <v-list-group class="title mt-1" :value="resultGroup">
            <template v-slot:activator="{ props }">
              <v-list-item v-bind="props" title="成果管理">
                <v-icon icon="mdi-chevron-down" color="#1D3D6C" size="large"></v-icon>
              </v-list-item>
            </template>
            <v-list-item v-for="item in resultItem" :key="item.id" :value="item.id" :title="item.name"
              @click="router.push({ path: '/' + item.id })"></v-list-item>
          </v-list-group>

          <v-list-group class="title mt-1" :value="backstageGroup">
            <template v-slot:activator="{ props }">
              <v-list-item v-bind="props" title="後台管理">
                <v-icon icon="mdi-chevron-down" color="#1D3D6C" size="large"></v-icon>
              </v-list-item>
            </template>
            <v-list-item v-for="item in backstageItem" :key="item.id" :value="item.id" :title="item.name"
              @click="router.push({ path: '/' + item.id })"></v-list-item>
          </v-list-group>
        </v-list>
        <v-sheet color="#1D3D6C" class="bottom" style="width: 15vw;height:8vh">
          <p class="text-white">
            {{ staffName }}<button type="button" @click="handleLogout" class="text-white ms-4">登出</button></p>
        </v-sheet>
      </v-navigation-drawer>
    </v-layout>
  </v-card>
</template>

<style scoped lang="scss">

:deep(.v-navigation-drawer .v-navigation-drawer--left .v-navigation-drawer--active .v-theme--light .side_bar){
  height: 0;
}
div.logo {
  position: fixed;
  cursor: pointer;
  background-color: $primaryBgBlue;
  @include flex_hm;
  padding: 8%;
  z-index: 999;

  img {
    width: 80%;
  }
}

div.title {
  text-align: center;
}

:deep(.v-list-item__content .v-list-item-title) {
  height: 5vh;
}

:deep(.v-list-item-title) {
  @include flex_vm;
}

:deep(.v-list-item__content) {
  @include flex_hm;
}


::v-deep .v-list-item__append .v-icon {
  display: none;
}

:deep(.v-list-group__items) {

  background-color: #F5F4EF;

  .v-list-item__content {
    .v-list-item-title {

      font-size: 1vw;
      color: #3D3A35;
    }
  }

}

:deep(.v-navigation-drawer__content) {
  height: 91vh;
}

:deep(.v-list-item__content) {

  .v-list-item-title {
    color: $primaryBgBlue;
    font-weight: bold;
    font-size: 1.2vw;
  }

}

div.bottom {
  @include flex_vm;
  position: fixed;
  bottom: 0;
}


</style>
