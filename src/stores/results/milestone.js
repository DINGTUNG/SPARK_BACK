import {
    defineStore
  } from 'pinia';
  
  import {
    reactive
  } from 'vue'
  import axios from 'axios';
  
  export const useMilestoneStore = defineStore('template', () => {
  
    const milestonePool = reactive([])
  
    // 【create】
    function createMilestoneBackend(milestoneTitle, milestoneDate, milestoneContent, milestoneImage) {
      // prepare data 
      const payLoad = new FormData();
      payLoad.append("milestone_title", milestoneTitle);
      payLoad.append("milestone_date", milestoneDate);
      payLoad.append("milestone_content", milestoneContent);
      payLoad.append("milestone_image", milestoneImage);

      // make a request
      const request = {
        method: "POST",
        url: `http://localhost/SPARK_BACK/php/results/milestone/create_milestone.php`,
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
            console.log("From createMilestoneBackend:", error);
            reject(error);
          });
      });
    }
  
  
    return {
      milestonePool,
      createMilestoneBackend,
    }
  
  })