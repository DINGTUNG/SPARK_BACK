import { defineStore } from 'pinia';
import { reactive } from 'vue'
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
  function updateNewsStatusBackend(newsNo, newsOnline) {
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
  const updateNewsStatusFromNewsPool = (newsNo, newsOnline) => {
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
    payLoad.append("news_title", newsForUpdate.newsTitle);
    payLoad.append("news_date", newsForUpdate.newsDate);
    payLoad.append("news_content_first", newsForUpdate.newsContentFirst);
    payLoad.append("news_image_first", newsForUpdate.newsImageFirst[0]);
    payLoad.append("news_content_second", newsForUpdate.newsContentSecond);
    payLoad.append("news_image_second", newsForUpdate.newsImageSecond[0]);
    payLoad.append("news_content_third", newsForUpdate.newsContentThird);
    payLoad.append("news_image_third", newsForUpdate.newsImageThird[0]);
    payLoad.append("news_content_fourth", newsForUpdate.newsContentFourth);
    payLoad.append("news_image_fourth", newsForUpdate.newsImageFourth[0]);


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

  const updateNewsFromNewsPool = (newsForUpdate) => {
    for (let i = 0; i < newsPool.length; i++) {
      if (newsPool[i].news_no == newsForUpdate.newsNo) {
        newsPool[i].news_date = newsForUpdate.newsDate
        newsPool[i].news_title = newsForUpdate.newsTitle
        newsPool[i].news_content_first = newsForUpdate.newsContentFirst
        newsPool[i].news_image_first = newsForUpdate.newsImageFirst
        newsPool[i].news_content_second = newsForUpdate.newsContentSecond
        newsPool[i].news_image_second = newsForUpdate.newsImageSecond
        newsPool[i].news_content_third = newsForUpdate.newsContentThird
        newsPool[i].news_image_fourth = newsForUpdate.newsImageFourth
      }
    }
  }


  // create
  function createNewsBackend(newsForUpdate) {
    validateNewsForUpdate(newsForUpdate);
    const payLoad = {
      "news_no": newsForUpdate.newsNo,
      "news_title": newsForUpdate.newsTitle,
      "news_date": newsForUpdate.newsDate,
      "news_content_first": newsForUpdate.newsContentFirst,
      "news_image_first": newsForUpdate.newsImageFirst[0],
      "news_content_second": newsForUpdate.newsContentSecond,
      "news_image_second": newsForUpdate.newsImageSecond[0],
      "news_content_third": newsForUpdate.newsContentThird,
      "news_image_third": newsForUpdate.newsImageThird[0],
      "news_content_fourth": newsForUpdate.newsContentFourth,
      "news_image_fourth": newsForUpdate.newsImageFourth[0],
    }

    // make a request
    const request = {
      method: "POST",
      url: `http://localhost/SPARK_BACK/php/news/create_news.php`,
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
          console.log("From createNewsBackend:", error);
          reject(error);
        });
    });
  }
  
  return {
    newsPool,
    deleteNewsBackend,
    deleteNewsFromMessagePool,
    updateNewsStatusBackend,
    updateNewsStatusFromNewsPool,
    updateNewsBackend,
    updateNewsFromNewsPool,
    createNewsBackend,
  }
})