import {
  defineStore
} from 'pinia';

import {
  ref,reactive
} from 'vue'
import axios from 'axios';

export const useMessageBoardStore = defineStore('template', () => {

  const messagePool = reactive([])

  // delete
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

  const deleteMessageFromMessagePool = (messageNo) => {
    for (let i = 0; i < messagePool.length; i++) {
      if (messagePool[i].message_no == messageNo) {
        messagePool.splice(i, 1);
        break
      }
    }
  }

  // update
  function updateMessageBackend(messageNo,messageContent) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("message_no", messageNo);
    payLoad.append("message_content", messageContent);

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

  const messageContent = ref('')
  const updateMessageFromMessagePool = (messageNo) => {
    for (let i = 0; i < messagePool.length; i++) {
      if (messagePool[i].message_no == messageNo) {
      messagePool[i].message_content = messageContent.value
      //  console.log(messageContent.value);
      }
    }
  }

  return {
    messagePool,
    deleteMessageBackend,
    deleteMessageFromMessagePool,
    updateMessageBackend,
    updateMessageFromMessagePool,
    messageContent,
  }

})