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
       alert('Like has been created');
    }
    // remove  like method
    async removeLike(){
        alert("Like has been remove");
    }

};

export default Like;