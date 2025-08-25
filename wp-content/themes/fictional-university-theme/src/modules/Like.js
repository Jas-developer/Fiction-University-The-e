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

      const likeBoxData = e.currentTarget;
       
       if(likeBoxData.dataset.exists === 'yes'){
          this.removeLike(likeBoxData)
       }else{
          this.createLike(likeBoxData)
       }


       
    }
    
    // create like method
    async createLike(likeBoxData){
       const likeUrl = universityData.archive_routes.root_url+'/wp-json/university/v1/manageLike';
       const professorId = likeBoxData.getAttribute('professor-id');
       const res = await axios.post(likeUrl,{
         'professor-id':professorId
       },{ headers:{
         'X-WP-Nonce':universityData.archive_routes.nonce
       }});

       console.log(likeBoxData);
       
       res ? console.log(res) : ' ';
      
    };

    
    // remove  like method
    async removeLike(likeBoxData){

      const professorId = likeBoxData.getAttribute("professor-id");

      const likeUrl = universityData.archive_routes.root_url+`/wp-json/university/v1/manageLike`;
      const res = await axios.delete(likeUrl)
       
      res ? console.log(res) : ' '
    }

};

export default Like;