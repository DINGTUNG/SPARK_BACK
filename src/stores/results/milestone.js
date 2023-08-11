import {
    defineStore
  } from 'pinia';
  
  import {
    reactive
  } from 'vue'
  import axios from 'axios';
  
  export const useMilestoneStore = defineStore('milestone', () => {
  
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


    // 【delete】
    function deleteMilestoneBackend(milestoneNo) {
      // prepare data 
      const payLoad = new FormData();
      payLoad.append("milestone_no", milestoneNo);

      // make a request
      const request = {
          method: "POST",
          url: `http://localhost/SPARK_BACK/php/results/milestone/delete_milestone.php`,
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
                  console.log("From deleteMilestoneBackend:", error);
                  reject(error);
              });
      });
    }

    const deleteMilestoneFromMilestonePool = (milestoneNo) => {
        for (let i = 0; i < milestonePool.length; i++) {
            if (milestonePool[i].milestone_no == milestoneNo) {
              milestonePool.splice(i, 1);
                break
            }
        }
    }
  
  
    return {
      milestonePool,
      createMilestoneBackend,
      deleteMilestoneBackend,
      deleteMilestoneFromMilestonePool,
    }
  
  })