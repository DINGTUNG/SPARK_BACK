import {
  defineStore
} from 'pinia';

import {reactive} from 'vue'
import axios from 'axios';

export const useMessageBoardStore = defineStore('template', () => {
  
  const messagePool = reactive([])

  
  function deleteMessageBackend(messageNo) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("message_no", messageNo);
  
    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/activity/message-board/delete_message.php`,
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
  
  const deleteMessageFromMessagePool = (messageNo)=> {
    for (let i = 0; i < messagePool.length; i++) {
      if (messagePool[i].message_no == messageNo) {
        messagePool.splice(i, 1);
        break
      }
    }
  } 




  return {
    messagePool,
    deleteMessageBackend,
    deleteMessageFromMessagePool
  }
  
})