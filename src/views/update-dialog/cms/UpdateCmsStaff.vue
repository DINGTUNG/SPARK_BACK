<script setup>
import { ref, defineProps } from 'vue'
import { useCmsStaffStore } from '@/stores/cms-staff.js';
const cmsStaffStore = useCmsStaffStore();


const vueProps = defineProps({
    staffNoForUpdate: Number,
    staffAccountForUpdate: String,
    staffPasswordForUpdate: String,
})

const staffAccount = ref('')
const staffPassword = ref('')

const dialogDisplay = ref(false);

function showDialog() {
    dialogDisplay.value = true;
    staffAccount.value = vueProps.staffAccountForUpdate
    staffPassword.value = vueProps.staffPasswordForUpdate
}

function closeDialog() {
    dialogDisplay.value = false;
}


async function updateStaff(staffNoForUpdate, staffAccount, staffPassword) {
    try {
        if (staffNoForUpdate == null) {
            throw new Error("Staff no. not found!")
        }
        await cmsStaffStore.updateStaffBackend(staffNoForUpdate, staffAccount, staffPassword)
        cmsStaffStore.updateStaffFromStaffPool(staffNoForUpdate, staffAccount, staffPassword)
        window.alert(`編輯成功!`);
    } catch (error) {
        console.error(error);
        window.alert(`http status : ${error.response.data} 編輯失敗!請聯絡管理員!`);
    } finally {
        closeDialog()
    }
}

// const dialog = ref(false);

</script>

<template>
    <v-row class="row" style="flex: 0;">
        <v-dialog v-model="dialogDisplay" persistent width="50%">
            <template v-slot:activator="{ props }">
                <v-icon size="small" class="me-2 icon" v-bind="props" @click="showDialog">mdi-pencil</v-icon>
            </template>
            <v-card>
                <v-card-title>
                    <span class="main_title">編輯後台人員</span>
                </v-card-title>
                <v-card-text>
                    <form action="http://localhost/SPARK_BACK/php/cms/update_staff.php" method="post"
                        @submit.prevent="updateStaff(vueProps.staffNoForUpdate, staffAccount, staffPassword)">
                        <label for="staff_account">
                            <div class="input_title">帳號</div>
                            <input type="text" name="staff_account" v-model="staffAccount">
                        </label>
                        <label for="">
                            <div class="input_title">密碼</div>
                            <input type="text" name="staff_password" v-model="staffPassword">
                        </label>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn class="cancel btn" variant="text" @click="closeDialog">
                                取消
                            </v-btn>
                            <v-btn class="update btn" variant="text" type="submit">
                                儲存
                            </v-btn>
                        </v-card-actions>
                    </form>
                </v-card-text>

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
    border-radius: 60px;
    overflow: hidden;
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

.main_title {
    display: block;
    color: $primaryBrandBlue;
    @include h1_PC;
    margin: 24px 0;
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

    //用來固定欄位名的寬度，方便對齊
    .input_title {
        width: 4vw;
        text-align: right;
        @include h4_PC;
    }

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
    margin: 30px 20px 60px 0;
    // margin-bottom: 50px;
    // margin-right: 20px;
    @include h5_PC;
}

:deep(.v-btn__content) {
    font-size: 20px;
}
</style>
