import {
  defineStore
} from 'pinia';

import {
  reactive
} from 'vue'
import axios from 'axios';

export const useSparkActivityStore = defineStore('spark-activity', () => {

  const sparkActivityPool = reactive([])

  // delete
  function deleteSparkActivityBackend(sparkActivityNo) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("spark_activity_no", sparkActivityNo);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/activity/spark-activity/delete_spark_activity.php`,
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
          console.log("From deleteSparkActivityBackend:", error);
          reject(error);
        });
    });
  }

  const deleteSparkActivityFromSparkActivityPool = (sparkActivityNo) => {
    for (let i = 0; i < sparkActivityPool.length; i++) {
      if (sparkActivityPool[i].spark_activity_no == sparkActivityNo) {
        sparkActivityPool.splice(i, 1);
        
        break
      }
    }
  }

  // update
  function updateSparkActivityBackend(sparkActivityNo, sparkActivityName, sparkActivityDescription, sparkActivityStartDate, sparkActivityEndDate) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("spark_activity_no", sparkActivityNo);
    payLoad.append("spark_activity_name", sparkActivityName);
    payLoad.append("spark_activity_description", sparkActivityDescription);
    payLoad.append("spark_activity_start_date", sparkActivityStartDate);
    payLoad.append("spark_activity_end_date", sparkActivityEndDate);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/activity/spark-activity/update_spark_activity.php`,
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
          console.log("From updateSparkActivityBackend:", error);
          reject(error);
        });
    });
  }

  const updateSparkActivityFromSparkActivityPool = (sparkActivityNo, sparkActivityName, sparkActivityDescription, sparkActivityStartDate, sparkActivityEndDate) => {
    for (let i = 0; i < sparkActivityPool.length; i++) {
      if (sparkActivityPool[i].spark_activity_no == sparkActivityNo) {
      sparkActivityPool[i].spark_activity_name = sparkActivityName
      sparkActivityPool[i].spark_activity_description = sparkActivityDescription
      sparkActivityPool[i].spark_activity_start_date = sparkActivityStartDate
      sparkActivityPool[i].spark_activity_end_date = sparkActivityEndDate
      }
    }
  }

  // update status
  function updateSparkActivityOnlineStatusBackend(sparkActivityNo,isSparkActivityOnline) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("spark_activity_no", sparkActivityNo);
    payLoad.append("is_spark_activity_online", isSparkActivityOnline);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/activity/spark-activity/update_spark_activity_online_status.php`,
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
          console.log("From updateSparkActivityOnlineStatusBackend:", error);
          reject(error);
        });
    });
  }

  const updateOnlineStatusFromSparkActivityPool = (sparkActivityNo,isSparkActivityOnline) => {
    for (let i = 0; i < sparkActivityPool.length; i++) {
      if (sparkActivityPool[i].spark_activity_no == sparkActivityNo) {
        sparkActivityPool[i].is_spark_activity_online = isSparkActivityOnline
      }
    }
  }


  // create
  function createSparkActivityBackend(sparkActivityName,sparkActivityDescription,sparkActivityStartDate,sparkActivityEndDate) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("spark_activity_name", sparkActivityName);
    payLoad.append("spark_activity_description", sparkActivityDescription);
    payLoad.append("spark_activity_start_date", sparkActivityStartDate);
    payLoad.append("spark_activity_end_date", sparkActivityEndDate);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/activity/spark-activity/create_spark_activity.php`,
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
          console.log("From createSparkActivityBackend:", error);
          reject(error);
        });
    });
  }


  return {
    sparkActivityPool,
    deleteSparkActivityBackend,
    deleteSparkActivityFromSparkActivityPool,
    updateSparkActivityBackend,
    updateSparkActivityFromSparkActivityPool,
    updateSparkActivityOnlineStatusBackend,
    updateOnlineStatusFromSparkActivityPool,
    createSparkActivityBackend
  }

})