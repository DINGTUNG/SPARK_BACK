import {
  defineStore
} from 'pinia';

import {
  reactive
} from 'vue'
import axios from 'axios';

export const useSponsorOrderStore = defineStore('sponsor-order', () => {

  const sponsorOrderPool = reactive([])
  

  // update order status
  function updateSponsorOrderStatusBackend(sponsorOrderNo,orderStatus) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("sponsor_order_no", sponsorOrderNo);
    payLoad.append("order_status", orderStatus);

    // make a request
    const request = {
      method: "POST",
      url: `https://tibamef2e.com/chd102/g3/back-end/php/sponsor/sponsor-order/update_sponsor_order_status.php`,
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
          console.log("From updateSponsorOrderStatusBackend:", error);
          reject(error);
        });
    });
  }

  const updateOrderStatusFromSponsorOrderPool = (sponsorOrderNo,orderStatus) => {
    for (let i = 0; i < sponsorOrderPool.length; i++) {
      if (sponsorOrderPool[i].sponsor_order_no == sponsorOrderNo) {
      sponsorOrderPool[i].order_status = orderStatus
      }
    }
  }
  
  // update children id
  function updateSponsorOrderBackend(sponsorOrderNo,childrenId) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("sponsor_order_no", sponsorOrderNo);
    payLoad.append("children_id", childrenId);

    // make a request
    const request = {
      method: "POST",
      url: `https://tibamef2e.com/chd102/g3/back-end/php/sponsor/sponsor-order/update_sponsor_order.php`,
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
          console.log("From updateSponsorOrderBackend:", error);
          reject(error);
        });
    });
  }

  const updateSponsorOrderFromSponsorOrderPool = (sponsorOrderNo,childrenId) => {
    for (let i = 0; i < sponsorOrderPool.length; i++) {
      if (sponsorOrderPool[i].sponsor_order_no == sponsorOrderNo) {
      sponsorOrderPool[i].children_id = childrenId
      }
    }
  }
  

  return {
    sponsorOrderPool,
    updateSponsorOrderStatusBackend,
    updateOrderStatusFromSponsorOrderPool,
    updateSponsorOrderBackend,
    updateSponsorOrderFromSponsorOrderPool
  }

})