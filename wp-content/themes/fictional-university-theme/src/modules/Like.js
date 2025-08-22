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
        alert("The Click Handler Method is Working");
        console.log(e.currentTarget.getAttribute("test-res"))
    }


};

export default Like;