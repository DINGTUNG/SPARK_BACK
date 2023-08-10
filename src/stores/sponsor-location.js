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
          console.log("From deleteMessageBackend:", error);
          reject(error);
        });
    });
  }

  const deleteLocationFromLocationList = (messageNo) => {
    for (let i = 0; i < locationList.length; i++) {
      if (locationList[i].location_no == locationList) {
        locationList.splice(i, 1);
        break
      }
    }
  }



  return {
    locationList,
    deleteLocationBackend,// 發出請求去後端抓取資料的過程
    deleteLocationFromLocationList,//
    
  }

})