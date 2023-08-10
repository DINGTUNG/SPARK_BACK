import {
  defineStore
} from 'pinia';

import {
  reactive
} from 'vue'
import axios from 'axios';

export const useNewsStore = defineStore('news', () => {

  const newsPool = reactive([])

  // // delete
  // function deleteMessageBackend(messageNo) {
  //   // prepare data 
  //   const payLoad = new FormData();
  //   payLoad.append("message_no", messageNo);

  //   // make a request
  //   const request = {
  //     method: "POST",
  //     url: `http://localhost/SPARK_BACK/php/activity/message-board/delete_message.php`,
  //     headers: {
  //       "Content-Type": "multipart/form-data",
  //     },
  //     data: payLoad,
  //   };

  //   // send request to backend server
  //   return new Promise((resolve, reject) => {
  //     axios(request)
  //       .then((response) => {
  //         const deleteResult = response.data;
  //         resolve(deleteResult);
  //       })
  //       .catch((error) => {
  //         console.log("From deleteMessageBackend:", error);
  //         reject(error);
  //       });
  //   });
  // }

  // const deleteMessageFromMessagePool = (messageNo) => {
  //   for (let i = 0; i < messagePool.length; i++) {
  //     if (messagePool[i].message_no == messageNo) {
  //       messagePool.splice(i, 1);
  //       break
  //     }
  //   }
  // }

  // update
  function updateNewsBackend(newsNo,newsDate,newsImageFirst) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("news_no", newsNo);
    payLoad.append("news_date", newsDate);
    payLoad.append("news_image_first", newsImageFirst.files[0]);


    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/news/update_news.php`,
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
          console.log("From updateNewsBackend:", error);
          reject(error);
        });
    });
  }

  const updateNewsFromNewsPool = (newsNo,newsDate,newsImageFirst) => {
    for (let i = 0; i < newsPool.length; i++) {
      if (newsPool[i].news_no == newsNo) {
        newsPool[i].news_date = newsDate
        newsPool[i].news_image_first = newsImageFirst.files[0]
      }
    }
  }

  // // create
  // function createNewsBackend(newsDate,newsImageFirst) {
  //   // prepare data 
  //   const payLoad = new FormData();
  //   payLoad.append("message_content", messageContent);

  //   // make a request
  //   const request = {
  //     method: "POST",
  //     url: `http://localhost/SPARK_BACK/php/activity/message-board/create_message.php`,
  //     headers: {
  //       "Content-Type": "multipart/form-data",
  //     },
  //     data: payLoad,
  //   };

  //   // send request to backend server
  //   return new Promise((resolve, reject) => {
  //     axios(request)
  //       .then((response) => {
  //         const createResult = response.data;
  //         resolve(createResult);
  //       })
  //       .catch((error) => {
  //         console.log("From createMessageBackend:", error);
  //         reject(error);
  //       });
  //   });
  // }


  return {
    newsPool,
    updateNewsBackend,
    updateNewsFromNewsPool,
    // createNewsBackend
  }

})