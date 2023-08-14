import {
    defineStore
} from 'pinia';

import {
    reactive
} from 'vue'
import axios from 'axios';

export const useThanksLetterStore = defineStore('thanks-letter', () => {

    const thanksLetterPool = reactive([])

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