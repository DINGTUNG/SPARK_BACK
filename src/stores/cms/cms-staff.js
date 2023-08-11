import {
    defineStore
} from 'pinia';

import {
    reactive
} from 'vue'
import axios from 'axios';

export const useCmsStaffStore = defineStore('cms_staff', () => {

    const staffPool = reactive([])


    // create
    function createStaffBackend(staffName, staffPermission, staffEmail, staffAccount, staffPassword) {
        // prepare data 
        const payLoad = new FormData();
        payLoad.append("staff_name", staffName);
        payLoad.append("staff_permission", staffPermission);
        payLoad.append("staff_email", staffEmail);
        payLoad.append("staff_account", staffAccount);
        payLoad.append("staff_password", staffPassword);

        // make a request
        const request = {
            method: "POST",
            url: `http://localhost/SPARK_BACK/php/cms/create_staff.php`,
            headers: {
                "Content-Type": "multipart/form-data",
            },
            data: payLoad,
        };

        // send request to backend server
        return new Promise((resolve, reject) => {
            axios(request)
                .then((response) => {
                    const createResult = response.data;
                    resolve(createResult);
                })
                .catch((error) => {
                    console.log("From createStaffBackend:", error);
                    reject(error);
                });
        });
    }


    // delete
    function deleteStaffBackend(staffNo) {
        // prepare data 
        const payLoad = new FormData();
        payLoad.append("staff_no", staffNo);

        // make a request
        const request = {
            method: "POST",
            url: `http://localhost/SPARK_BACK/php/cms/delete_staff.php`,
            headers: {
                "Content-Type": "multipart/form-data",
            },
            data: payLoad,
        };

        // send request to backend server
        return new Promise((resolve, reject) => {
            axios(request)
                .then((response) => {
                    const deleteResult = response.data;
                    resolve(deleteResult);
                })
                .catch((error) => {
                    console.log("From deleteStaffBackend:", error);
                    reject(error);
                });
        });
    }

    const deleteStaffFromStaffPool = (staffNo) => {
        for (let i = 0; i < staffPool.length; i++) {
            if (staffPool[i].staff_no == staffNo) {
                staffPool.splice(i, 1);
                break
            }
        }
    }


    // update
    function updateStaffBackend(staffNo, staffAccount, staffPassword) {
        // prepare data 
        const payLoad = new FormData();
        payLoad.append("staff_no", staffNo);
        payLoad.append("staff_account", staffAccount);
        payLoad.append("staff_password", staffPassword);

        // make a request
        const request = {
            method: "POST",
            url: `http://localhost/SPARK_BACK/php/cms/update_staff.php`,
            headers: {
                "Content-Type": "multipart/form-data",
            },
            data: payLoad,
        };

        // send request to backend server
        return new Promise((resolve, reject) => {
            axios(request)
                .then((response) => {
                    const updateResult = response.data;
                    resolve(updateResult);
                })
                .catch((error) => {
                    console.log("From updateMessageBackend:", error);
                    reject(error);
                });
        });
    }

    const updateStaffFromStaffPool = (staffNo, staffAccount, staffPassword) => {
        for (let i = 0; i < staffPool.length; i++) {
            if (staffPool[i].staff_no == staffNo) {
                staffPool[i].staff_account = staffAccount
                staffPool[i].staff_password = staffPassword
            }
        }
    }


    return {
        staffPool,
        createStaffBackend,
        deleteStaffBackend,
        deleteStaffFromStaffPool,
        updateStaffBackend,
        updateStaffFromStaffPool

    }

})