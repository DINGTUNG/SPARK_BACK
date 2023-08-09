import {
    defineStore
} from 'pinia';

import {
    reactive
} from 'vue'
import axios from 'axios';


export const useReportStore = defineStore('Report', () => {

    const reportsList = reactive([])

    function deleteReportBackend(reportNo) {
        // prepare data 
        const payLoad = new FormData();
        payLoad.append("report_no", reportNo);

        // make a request
        const request = {
            method: "POST",
            url: `http://localhost/SPARK_BACK/php/results/reports/delete_reports.php`,
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
                    console.log("Error from deleteReportBackend:", error);
                    reject(error);
                });
        });
    }

    const deleteReportFromMessagePool = (reportNo) => {
        for (let i = 0; i < reportsList.length; i++) {
            if (reportsList[i].report_no == reportNo) {
                reportsList.splice(i, 1);
                break
            }
        }
    }

    return {
        reportsList,
        deleteReportBackend,
        deleteReportFromMessagePool,
    }
})