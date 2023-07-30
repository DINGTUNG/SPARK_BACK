<script setup>
// import SideBar from '../spark-back/SideBar.vue';
import { ref, reactive,computed  } from 'vue'
const page = ref(1)
const dialog = ref(false)

const dialogDelete = ref(false); // 控制刪除對話框的顯示
const itemToDelete = ref(null); // 存儲要刪除的項目

function showDeleteDialog(item) {
  itemToDelete.value = item; // 存儲要刪除的項目
  dialogDelete.value = true; // 顯示刪除對話框
}

function deleteItemConfirm() {
  // 不直接執行刪除操作，僅關閉刪除對話框，讓使用者確認是否刪除
  closeDelete(); // 關閉刪除對話框
}

function closeDelete() {
  dialogDelete.value = false; // 隱藏刪除對話框
  if (itemToDelete.value) {
    const confirmDelete = confirm("是否確定要刪除？");
    if (confirmDelete) {
      const index = donateList.indexOf(itemToDelete.value);
      if (index !== -1) {
        donateList.splice(index, 1); // 從列表中刪除項目沒效 
      }
    }
    itemToDelete.value = null; // 清空要刪除的項目
  }
}

// 換頁
const itemsPerPage = 8;
  const displayedDonateList = computed(() => {
    const startIdx = (page.value - 1) * itemsPerPage;
    const endIdx = startIdx + itemsPerPage;
    return donateList.slice(startIdx, endIdx);
  });


const donateList = reactive([
  {
    no: '1',
    member_no:'003',
    location_no: '001',
    sponsor_date:'2023-07-28',
    price:'2000',
    payment_plan:'月繳',
    payment_method:'信用卡',
    children_no:'567',
    expiry_month:'202408'

  },
  {
    no: '2',
    member_no:'003',
    location_no: '001',
    sponsor_date:'2023-07-28',
    price:'2000',
    payment_plan:'月繳',
    payment_method:'信用卡',
    children_no:'567',
    expiry_month:'202408'

  },
  {
    no: '3',
    member_no:'003',
    location_no: '001',
    sponsor_date:'2023-07-28',
    price:'2000',
    payment_plan:'月繳',
    payment_method:'信用卡',
    children_no:'567',
    expiry_month:'202408'

  },
  {
    no: '4',
    member_no:'003',
    location_no: '001',
    sponsor_date:'2023-07-28',
    price:'2000',
    payment_plan:'月繳',
    payment_method:'信用卡',
    children_no:'567',
    expiry_month:'202408'
  },
])

</script>


<template>
  <div class="container">

    <div class="sidebar">
      <SideBar />
    </div>
    <div class="table_body">

      <h1>認養據點</h1>
      <v-table>
        <thead>
          <tr>
            <th>訂單編號</th>
            <th>會員編號</th>
            <th>地區編號</th>
            <th>認養日期</th>
            <th>金額</th>
            <th>定期繳款方式</th>
            <th>繳款方式</th>
            <th>兒童編號</th>
            <th>繳款到期月份</th>
            <th>狀態</th>
            <th>功能</th>
            <th>刪改</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in displayedDonateList" :key="item.id" class="no-border">
            <td class="no">{{ item.no }}</td>
            <td class="member_no">{{ item.member_no }}</td>
            <td class="location_no">{{ item.location_no }}</td>
            <td class="sponsor_date">{{ item.sponsor_date }}</td>
            <td class="price">{{ item.price }}</td>
            <td class="payment_plan">{{ item.payment_plan }}</td>
            <td class="payment_method">{{ item.payment_method }}</td>
            <td class="children_no">{{ item.children_no }}</td>
            <td class="expiry_month">{{ item.expiry_month }}</td>
            <td class="online">{{ item.online ? '已上架' : '未上架' }}</td>
            <td>
              <v-switch v-model="item.online" color="#EBC483" density="compact" hide-details="true" inline
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

      <v-btn class="text" min-width="100" color="#1D3D6C" :ripple="false" rounded="xl" size="x-large" variant="flat">新增</v-btn>

      <!-- 分頁 -->
      <div class="text-center">
        <v-pagination v-model="page" :length="3" rounded="circle" prev-icon="mdi-chevron-left"
          next-icon="mdi-chevron-right" active-color="#F5F4EF" color="#E7E6E1"></v-pagination>
      </div>
    </div>
    <v-dialog v-model="dialogDelete" max-width="800px" persistent="true">
      <v-card class="delete_dialog">
        <v-card-title class="text-center">
          確定是否要刪除此據點？
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
div.container {
  width: 100%;
  display: flex;
  justify-content: flex-start;


  div.sidebar {
    z-index: 100;

    div.logo {
      background-color: $primaryBgBlue;
      padding: 20px 0;
    }
  }


    div.table_body{
        width: 70%;
        margin: 150px auto 150px 330px;

        .v-table{
            margin-bottom: 50px;
        }

        th{
            @include h5_B_PC;
            color: $basicFontColor;
        }
        td{
            @include h6_PC;
            color: $basicFontColor;       
        }
        tbody tr:nth-child(odd) {
            background-color:$functionalLightGrey1;
        }      
        tbody tr:nth-child(even) {
        background-color: $primaryBrandWhite;
        }
        .no-border td{
            border: none;
        }

        :deep(.v-table .v-table__wrapper > table > thead > tr > th){
          border-bottom: 4px solid $primaryBrandBlue;
        }
        :deep(.v-switch--inset .v-switch__track){
          background-color:$primaryBrandBlue;
          opacity: 1;
        }
        :deep(.v-pagination__item--is-active .v-btn__overlay){
          border: 1px solid $secondaryDarkBlue;
          color:white;
          opacity: 0.2;
        }
        :deep(.mdi:before){
            color:$primaryBrandBlue;
        }
    }

    h1{
      color:$primaryBrandBlue;
      margin-bottom: 40px;
    }

    th {
      @include h5_B_PC;
      color: $basicFontColor;
    }

    td {
      @include h6_PC;
      color: $basicFontColor;
    }

    tbody tr:nth-child(odd) {
      background-color: $functionalLightGrey1;
    }

    tbody tr:nth-child(even) {
      background-color: $primaryBrandWhite;
    }

    .no-border td {
      border: none;
    }
    :deep(.v-card .v-card-title){
      line-height: 3em;
    }

  }


:deep(.text){
  span.v-btn__content {
    color: white;
  }
}
</style>
