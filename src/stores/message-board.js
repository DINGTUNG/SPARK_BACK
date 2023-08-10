import {
  defineStore
} from 'pinia';

import {
  reactive
} from 'vue'
import axios from 'axios';

export const useMessageBoardStore = defineStore('message-board', () => {

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
  function updateMessageBackend(messageNo,sparkActivityId,messageContent,memberId) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("message_no", messageNo);
    payLoad.append("spark_activity_no", sparkActivityId);
    payLoad.append("message_content", messageContent);
    payLoad.append("member_id", memberId);

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

  const updateMessageFromMessagePool = (messageNo,sparkActivityId,messageContent,memberId) => {
    for (let i = 0; i < messagePool.length; i++) {
      if (messagePool[i].message_no == messageNo) {
      messagePool[i].spark_activity_id = sparkActivityId
      messagePool[i].message_content = messageContent
      messagePool[i].member_id = memberId
      }
    }
  }

  // create
  function createMessageBackend(messageContent) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("message_content", messageContent);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/activity/message-board/create_message.php`,
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
          console.log("From createMessageBackend:", error);
          reject(error);
        });
    });
  }


  return {
    messagePool,
    deleteMessageBackend,
    deleteMessageFromMessagePool,
    updateMessageBackend,
    updateMessageFromMessagePool,
    createMessageBackend
  }

})