import { defineStore } from 'pinia';
import { reactive } from 'vue'
import axios from 'axios';
export const useReportStore = defineStore('Report', () => {
    const reportList = reactive([])
    //delete
    function deleteReportBackend(reportNo) {
        // prepare data 
        const payLoad = new FormData();
        payLoad.append("report_no", reportNo);
        // make a request
        const request = {
            method: "POST",
            url: `http://localhost/SPARK_BACK/php/results/report/delete_report.php`,
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
    const deleteReportFromReportList = (reportNo) => {
        for (let i = 0; i < reportList.length; i++) {
            if (reportList[i].report_no == reportNo) {
                reportList.splice(i, 1);
                break
            }
        }
    }

    //status
    function updateReportOnlineBackend(reportNo,reportOnline) {
      // prepare data 
      const payLoad = new FormData();
      payLoad.append("report_no", reportNo);
      payLoad.append("is_report_online", reportOnline);
  
      // make a request
      const request = {
        method: "POST",
        url: `http://localhost/SPARK_BACK/php/results/report/report_status.php`,
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
            console.log("From updateReportOnlineBackend:", error);
            reject(error);
          });
      });
    }
  
    const updateReportFromReportList = (reportNo,reportOnline) => {
      for (let i = 0; i < reportList.length; i++) {
        if (reportList[i].report_no == reportNo) {
        reportList[i].is_report_online = reportOnline
        }
      }
    }


    //update
    function updateReportBackend(reportForUpdate) {

        // prepare data 
        const payLoad = new FormData();
        payLoad.append("report_no", reportForUpdate.reportNo);
        payLoad.append("report_class", reportForUpdate.reportClass);
        payLoad.append("report_year", reportForUpdate.reportYear);
        payLoad.append("report_title", reportForUpdate.reportTitle);
        payLoad.append("report_file_path", reportForUpdate.reportFile[0]);
    
        // make a request
        const request = {
          method: "POST",
          url: `http://localhost/SPARK_BACK/php/results/report/update_report.php`,
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
              console.log('Backend Response:', updateResult); 
              resolve(updateResult);
            })
            .catch((error) => {
              console.log("From updateReportBackend:", error);
              reject(error);
            });
        });
      }

      const updateReportFileFromReportList = (reportForUpdate) => {
        console.log("1",reportList);
        for (let i = 0; i < reportList.length; i++) {
          if (reportList[i].report_no ==  reportForUpdate.reportNo) {
            reportList[i].report_class = reportForUpdate.reportClass
            reportList[i].report_year = reportForUpdate.reportYear
            reportList[i].report_title = reportForUpdate.reportTitle
            reportList[i].report_file_path = reportForUpdate.reportFile
          }
        }
        console.log("2",reportList);
      }

    //create
    function createReportBackend(reportForCreate) {
      const payLoad = {
        "report_no": reportForCreate.reportNo,
        "report_class": reportForCreate.reportClass,
        "report_title": reportForCreate.reportTitle,
        "report_year": reportForCreate.reportYear,
        "report_file_path": reportForCreate.reportFile[0],
      }
      const request = {
        method: "POST",
        url: `http://localhost/SPARK_BACK/php/results/report/create_report.php`,
        headers: {
          "Content-Type": "multipart/form-data",
        },
        data: payLoad,
      };


      return new Promise((resolve, reject) => {
        axios(request)
          .then((response) => {
            const createResult = response.data;
            resolve(createResult);
          })
          .catch((error) => {
            console.log("From createReportBackend:", error);
            reject(error);
          });
      });
    
    }

    return {
        reportList,
        deleteReportBackend,
        deleteReportFromReportList,
        updateReportOnlineBackend,
        updateReportFromReportList,
        updateReportBackend,
        updateReportFileFromReportList,
        createReportBackend,
      }
})