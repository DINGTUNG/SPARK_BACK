import {
  defineStore
} from 'pinia';

import {
  reactive
} from 'vue'
import axios from 'axios';

export const useNewsStore = defineStore('news', () => {
  const newsPool = reactive([])

  // delete
  function deleteNewsBackend(newsNo) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("news_no", newsNo);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/news/delete_news.php`,
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

  const deleteNewsFromMessagePool = (newsNo) => {
    for (let i = 0; i < newsPool.length; i++) {
      if (newsPool[i].news_no == newsNo) {
        newsPool.splice(i, 1);
        break
      }
    }
  }

  // status
  function updateNewsStatusBackend(newsNo,newsOnline) {
    // prepare data 
    const payLoad = new FormData();
    payLoad.append("news_no", newsNo);
    payLoad.append("is_news_online", newsOnline);

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/news/news_status.php`,
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
  const updateNewsStatusFromNewsPool = (newsNo,newsOnline) => {
    for (let i = 0; i < newsPool.length; i++) {
      if (newsPool[i].news_no == newsNo) {
      newsPool[i].is_news_online = newsOnline
      }
    }
  }


  // update
  function updateNewsBackend(newsForUpdate) {

    validateNewsForUpdate(newsForUpdate); //not finished

    // prepare data 
    const payLoad = new FormData();
    payLoad.append("news_no", newsForUpdate.newsNo);
    payLoad.append("news_date", newsForUpdate.newsDate);
    payLoad.append("news_image_first", newsForUpdate.newsImageFirst[0]);
    payLoad.append("news_image_second", newsForUpdate.newsImageSecond[0]);


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

  const validateNewsForUpdate = (newsNoForUpdate) => {
    return newsNoForUpdate
  }

  const updateNewsFromNewsPool = (newsNoForUpdate) => {
    for (let i = 0; i < newsPool.length; i++) {
      if (newsPool[i].news_no == newsNoForUpdate.newsNo) {
        newsPool[i].news_date = newsNoForUpdate.newsDate
        newsPool[i].news_image_first = newsNoForUpdate.newsImageFirst
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
    deleteNewsBackend,
    deleteNewsFromMessagePool,
    updateNewsStatusBackend,
    updateNewsStatusFromNewsPool,
    updateNewsBackend,
    updateNewsFromNewsPool,
    // createNewsBackend
  }

})