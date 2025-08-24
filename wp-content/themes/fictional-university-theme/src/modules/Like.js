import axios from "axios";



class Like{
      constructor(){
        this.events();
      }

      events(){
        //like box
        const likeBox = document.querySelector(".like-box");
        if(likeBox){

           likeBox.addEventListener("click", e => {
             this.clickHandler(e)
           }); 
        }


      }
    
    //methods
    async clickHandler(e){

      const likeStatus = e.currentTarget.dataset.exists;
       console.log(typeof likeStatus)
       
       if(likeStatus === 'yes'){
          this.removeLike()
       }else{
          this.createLike()
       }


       
    }
    
    // create like method
    async createLike(){
       const likeUrl = universityData.archive_routes.root_url+'/wp-json/university/v1/manageLike';

       const res = await axios.post(likeUrl)
       
       res ? console.log(res) : ' '
      
    }
    // remove  like method
    async removeLike(){
        const likeUrl = universityData.archive_routes.root_url+'/wp-json/university/v1/manageLike';

       const res = await axios.delete(likeUrl)
       
       res ? console.log(res) : ' '
    }

};

export default Like;