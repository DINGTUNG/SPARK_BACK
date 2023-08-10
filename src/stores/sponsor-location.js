import {
  defineStore
} from 'pinia';

import {
  reactive
} from 'vue'
import axios from 'axios';

export const useSponsorLocationStore = defineStore('sponsor-location', () => {

  const locationList = reactive([]);

  // delete
  function deleteLocationBackend(locationNo) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("location_no", locationNo);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/sponsor/sponsor-location/delete_sponsor_location.php`,
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
          console.log("From deleteLocationBackend:", error);
          reject(error);
        });
    });
  }
  const deleteLocationFromLocationList = (locationNo) => {
    for (let i = 0; i < locationList.length; i++) {
      if (locationList[i].location_no == locationNo) {
        locationList.splice(i, 1);
        break
      }
    }
  }


  function createLocationBackend(locationName) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("location_name", locationName);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/sponsor/sponsor-location/create_sponsor_location.php`,
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
          console.log("From createLocationBackend:", error);
          reject(error);
        });
    });
  }




  return {
    locationList,
    deleteLocationBackend,// 發出請求去後端抓取資料的過程
    deleteLocationFromLocationList,//
    createLocationBackend

  }

})