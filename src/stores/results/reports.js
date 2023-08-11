import { defineStore } from 'pinia';
import { reactive } from 'vue'
import axios from 'axios';
export const useReportStore = defineStore('Report', () => {
    const reportsList = reactive([])
    //de
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
    //up
    function updateReportBackend(reportNo,reportClass,reportTitle,reportFilePath) {
        // prepare data 
        const payLoad = new FormData();
        payLoad.append("report_no", reportNo);
        payLoad.append("report_Class", reportClass);
        payLoad.append("report_Title", reportTitle);
        payLoad.append("reports_file_path", reportFilePath);
    
        // make a request
        const request = {
          method: "POST",
          url: `http://localhost/SPARK_BACK/php/activity/message-board/update_message.php`,
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
    
      const updateMessageFromMessagePool = (messageNo,sparkActivityId,messageContent,memberId) => {
        for (let i = 0; i < messagePool.length; i++) {
          if (messagePool[i].message_no == messageNo) {
          messagePool[i].spark_activity_id = sparkActivityId
          messagePool[i].message_content = messageContent
          messagePool[i].member_id = memberId
          }
        }
      }

    return {
        reportsList,
        deleteReportBackend,
        deleteReportFromMessagePool,
    }
})