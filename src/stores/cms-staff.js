import {
    defineStore
} from 'pinia';

import {
    reactive
} from 'vue'
import axios from 'axios';

export const useCmsStaffStore = defineStore('template', () => {

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


    return {
        staffPool,

        createStaffBackend
    }

})