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
    function createMilestoneBackend(milestoneForUpdate) {

      validateMilestoneForUpdate(milestoneForUpdate);

      // prepare data 
      const payLoad = {
          "milestone_no": milestoneForUpdate.milestoneNo,
          "milestone_title": milestoneForUpdate.milestoneTitle,
          "milestone_date": milestoneForUpdate.milestoneDate,
          "milestone_content": milestoneForUpdate.milestoneContent,
          "milestone_image": milestoneForUpdate.milestoneImage[0],
    }


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



    // 【update status】
    function updateMilestoneOnlineStatusBackend(milestoneNo,ismilestoneOnline) {
      // prepare data 
      const payLoad = new FormData();
      payLoad.append("milestone_no", milestoneNo);
      payLoad.append("is_milestone_online", ismilestoneOnline);

      // make a request
      const request = {
        method: "POST",
        url: `http://localhost/SPARK_BACK/php/results/milestone/milestone_status.php`,
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
            console.log("From updateMilestoneBackend:", error);
            reject(error);
          });
      });
    }

    const updateOnlineStatusFromMilestonePool = (milestoneNo,isMilestoneOnline) => {
      for (let i = 0; i < milestonePool.length; i++) {
        if (milestonePool[i].milestone_no == milestoneNo) {
          milestonePool[i].is_milestone_online = isMilestoneOnline
        }
      }
    }



    // 【update】
    function updateMilestoneBackend(milestoneNo, milestoneTitle, milestoneDate, milestoneContent, milestoneImage) {
      // prepare data 
      const payLoad = new FormData();
      payLoad.append("milestone_no", milestoneNo);
      payLoad.append("milestone_title", milestoneTitle);
      payLoad.append("milestone_date", milestoneDate);
      payLoad.append("milestone_content", milestoneContent);
      payLoad.append("milestone_image", milestoneImage);

      // make a request
      const request = {
          method: "POST",
          url: `http://localhost/SPARK_BACK/php/results/milestone/update_milestone.php`,
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
                  console.log("From updateMilestoneBackend:", error);
                  reject(error);
              });
      });
    }

    const validateMilestoneForUpdate = (milestoneNoForUpdate) => {
      return milestoneNoForUpdate
    }

    const updateMilestoneFromMilestonePool = (milestoneNo, milestoneTitle, milestoneDate, milestoneContent, milestoneImage) => {
      for (let i = 0; i < milestonePool.length; i++) {
          if (milestonePool[i].milestone_no == milestoneNo) {
              milestonePool[i].milestone_title = milestoneTitle
              milestonePool[i].milestone_date = milestoneDate
              milestonePool[i].milestone_content = milestoneContent
              milestonePool[i].milestone_image = milestoneImage
          }
      }
    }    



  
  
    return {
      milestonePool,
      createMilestoneBackend,
      deleteMilestoneBackend,
      deleteMilestoneFromMilestonePool,
      updateMilestoneOnlineStatusBackend,
      updateOnlineStatusFromMilestonePool,
      updateMilestoneBackend,
      updateMilestoneFromMilestonePool
    }
  
  })