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

    //status
    function updateReportOnlineBackend(reportNo,reportOnline) {
      // prepare data 
      const payLoad = new FormData();
      payLoad.append("report_no", reportNo);
      payLoad.append("is_report_online", reportOnline);
  
      // make a request
      const request = {
        method: "POST",
        url: `http://localhost/SPARK_BACK/php/results/reports/reports_status.php`,
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
  
    const updateReportFromReportsList = (reportNo,reportOnline) => {
      for (let i = 0; i < reportsList.length; i++) {
        if (reportsList[i].report_no == reportNo) {
        reportsList[i].is_report_online = reportOnline
        }
      }
    }


    //update
    function updateReportBackend(reportsNo, reportsClass, reportsYear, reportsTitle, reportsFile) {

        // prepare data 
        const payLoad = new FormData();
        payLoad.append("report_no", reportsNo);
        payLoad.append("report_class",reportsClass);
        payLoad.append("report_year", reportsYear);
        payLoad.append("report_title", reportsTitle);
        payLoad.append("reports_file_path",reportsFile[0]);
    
        // make a request
        const request = {
          method: "POST",
          url: `http://localhost/SPARK_BACK/php/results/reports/update_reports.php`,
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
              console.log("From updateReportsBackend:", error);
              reject(error);
            });
        });
      }

      const updateReportFileFromReportsList = (reportsNo, reportsClass, reportsYear, reportsTitle, reportsFile) => {
        for (let i = 0; i < reportsList.length; i++) {
          if (reportsList[i].report_no ==  reportsNo) {
            reportsList[i].report_class = reportsClass
            reportsList[i].reports_year = reportsYear
            reportsList[i].reports_title = reportsTitle
            reportsList[i].reports_file_path = reportsFile
          }
        }
      }

    //create
    function createReportsBackend(reportsForUpdate) {
      const payLoad = {
        "report_no": reportsForUpdate.reportNo,
        "report_class": reportsForUpdate.reportClass,
        "report_title": reportsForUpdate.reportTitle,
        "report_year": reportsForUpdate.reportYear,
        "reports_file_path": reportsForUpdate.reportsFile[0],
      }
    
    
      const request = {
        method: "POST",
        url: `http://localhost/SPARK_BACK/php/results/reports/create_reports.php`,
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
            console.log("From createReportsBackend:", error);
            reject(error);
          });
      });
    
    }

    return {
        reportsList,
        deleteReportBackend,
        deleteReportFromMessagePool,
        updateReportOnlineBackend,
        updateReportFromReportsList,
        updateReportBackend,
        updateReportFileFromReportsList,
        createReportsBackend,
      }
})