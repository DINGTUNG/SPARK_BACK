import {
    defineStore
} from 'pinia';

import {
    reactive
} from 'vue'
import axios from 'axios';

export const useThanksLetterStore = defineStore('thanks-letter', () => {

    const thanksLetterPool = reactive([])

    // delete
    function deleteThanksLetterBackend(thanksLetterId) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("thanks_letter_no", thanksLetterNo);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost:8888/member/thanks-letter/delete_letter.php`,
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
          console.log("From deleteThanksLetterBackend:", error);
          reject(error);
        });
    });
  }

    const deleteThanksLetterFromThanksLetterPool = (thanksLetterNo) => {
        for (let i = 0; i < thanksLetterPool.length; i++) {
        if (thanksLetterPool[i].thanks_letter_no == thanksLetterNo) {
            thanksLetterPool.splice(i, 1);
            break
        }
        }
    }


    // update
    function updateThanksLetterBackend(thanksLetterNo, childrenId, memberId, sponsorOrderId, receiveDate, fileName ) {

    // prepare data 
    const payLoad = new FormData();
    payLoad.append("thanks_letter_no", thanksLetterNo);
    payLoad.append("children_id", childrenId);
    payLoad.append("member_id", memberId);
    payLoad.append("sponsor_order_id", sponsorOrderId);
    payLoad.append("receive_date", receiveDate);
    payLoad.append("file_name", fileName[0]);


    // make a request
    const request = {
        method: "POST",
        url: `http://localhost:8888/member/thanks-letter/update_letter.php`,
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
            console.log("From updateThanksLetterBackend:", error);
            reject(error);
            });
    });
  }

  const updateThanksLetterFromThanksLetterPool = (thanksLetterNo, childrenId, memberId, sponsorOrderId, receiveDate, fileName ) => {
    for (let i = 0; i < thanksLetterPool.length; i++) {
        if (thanksLetterPool[i].thanks_letter_no == thanksLetterNo) {
            thanksLetterPool[i].children_id = childrenId
            thanksLetterPool[i].member_id = memberId
            thanksLetterPool[i].sponsor_order_id = sponsorOrderId
            thanksLetterPool[i].receive_date = receiveDate
            thanksLetterPool[i].file_name = fileName
        }
    }
  }


  // update status
  function updateThanksLetterSentStatusBackend(thanksLetterNo,isThanksLetterSent) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("thanks_letter_no", thanksLetterNo);
    payLoad.append("is_thanks_letter_sent", isThanksLetterSent);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost:8888/member/thanks-letter/update_thanks_letter_sent_status.php`,
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
          console.log("From updateThanksLetterSentStatusBackend:", error);
          reject(error);
        });
    });
  }

  const updateSentStatusFromThanksLetterPool = (thanksLetterNo,isThanksLetterSent) => {
    for (let i = 0; i < thanksLetterPool.length; i++) {
      if (thanksLetterPool[i].thanks_letter_no == thanksLetterNo) {
        sparkActivityPool[i].is_thanks_letter_sent = isThanksLetterSent
      }
    }
  }



    // create
    function CreateThanksLetterBackend(childrenId, memberId, sponsorOrderId, receiveDate, fileName) {
        // prepare data 
        const payLoad = new FormData();
        payLoad.append("children_id", childrenId);
        payLoad.append("member_id", memberId);
        payLoad.append("sponsor_order_id", sponsorOrderId);
        payLoad.append("receive_date", receiveDate);
        payLoad.append("file_name", fileName);

        // make a request
        const request = {
            method: "POST",
            url: `http://localhost:8888/member/thanks-letter/create_letter.php`,
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
                    console.log("From CreateThanksLetterBackend:", error);
                    reject(error);
                });
        });
    }


    return {
        thanksLetterPool,
        CreateThanksLetterBackend,
        deleteThanksLetterBackend,
        deleteThanksLetterFromThanksLetterPool,
        updateThanksLetterSentStatusBackend,
        updateSentStatusFromThanksLetterPool,
        updateThanksLetterBackend,
        updateThanksLetterFromThanksLetterPool,
    }

})