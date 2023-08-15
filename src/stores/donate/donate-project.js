import { defineStore } from 'pinia';
import { reactive } from 'vue'
import axios from 'axios';

export const useDonateStore = defineStore('donate_project', () => {
    const donatePool = reactive([])

    // delete
    function deleteDonateBackend(donateNo) {
        // prepare data 
        const payLoad = new FormData();
        payLoad.append("donate_project_no", donateNo);

        // make a request
        const request = {
            method: "POST",
            url: `http://localhost/SPARK_BACK/php/donate/donate-project/delete_donate_project.php`,
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
                    console.log("From deleteDonateBackend:", error);
                    reject(error);
                });
        });
    }

    const deleteDonateFromDonatePool = (donateNo) => {
        for (let i = 0; i < donatePool.length; i++) {
            if (donatePool[i].donate_project_no == donateNo) {
                donatePool.splice(i, 1);
                break
            }
        }
    }


    // update
    function updateDonateBackend(donateForUpdate) {

        validateDonateForUpdate(donateForUpdate); //not finished

        // prepare data 
        const payLoad = new FormData();
        payLoad.append("donate_project_no", donateForUpdate.donateNo);
        payLoad.append("donate_project_name", donateForUpdate.donateName);
        payLoad.append("donate_project_start_date", donateForUpdate.donateStartDate);
        payLoad.append("donate_project_end_date", donateForUpdate.donateEndDate);
        payLoad.append("donate_project_summarize", donateForUpdate.donateSummarize);
        payLoad.append("donate_project_image", donateForUpdate.donateImage[0]);


        // make a request
        const request = {
            method: "POST",
            url: `http://localhost/SPARK_BACK/php/donate/donate-project/update_donate_project.php`,
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
                    console.log("From updateDonateBackend:", error);
                    reject(error);
                });
        });
    }

    const validateDonateForUpdate = (donateNoForUpdate) => {
        return donateNoForUpdate
    }

    const updateDonateFromDonatePool = (donateForUpdate) => {
        for (let i = 0; i < donatePool.length; i++) {
            if (donatePool[i].donate_project_no == donateForUpdate.donateNo) {
                donatePool[i].donate_project_name = donateForUpdate.donateName
                donatePool[i].donate_project_start_date = donateForUpdate.donateStartDate
                donatePool[i].donate_project_end_date = donateForUpdate.donateEndDate
                donatePool[i].donate_project_summarize = donateForUpdate.donateSummarize
                donatePool[i].donate_project_image = donateForUpdate.donateImage
            }
        }
    }

    // create
    function createDonateBackend(donateForUpdate) {
        validateDonateForUpdate(donateForUpdate);
        // prepare data 
        // const payLoad = new FormData();
        // payLoad.append("donate_project_name", donateName);
        // payLoad.append("donate_project_start_date", donateStartDate);
        // payLoad.append("donate_project_end_date", donateEndDate);
        // payLoad.append("donate_project_summarize", donateSummarize);
        // payLoad.append("donate_project_image", donateImage);

        const payLoad = {
            "donate_project_no": donateForUpdate.donateNo,
            "donate_project_name": donateForUpdate.donateName,
            "donate_project_start_date": donateForUpdate.donateStartDate,
            "donate_project_end_date": donateForUpdate.donateEndDate,
            "donate_project_summarize": donateForUpdate.donateSummarize,
            "donate_project_image": donateForUpdate.donateImage[0],
        }



        // make a request
        const request = {
            method: "POST",
            url: `http://localhost/SPARK_BACK/php/donate/donate-project/create_donate_project.php`,
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
                    console.log("From createDonateBackend:", error);
                    reject(error);
                });
        });
    }




    return {
        donatePool,
        createDonateBackend,
        deleteDonateBackend,
        deleteDonateFromDonatePool,
        updateDonateBackend,
        updateDonateFromDonatePool
    }

})