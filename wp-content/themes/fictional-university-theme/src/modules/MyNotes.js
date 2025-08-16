import axios from "axios";


class MyNotes {
    constructor(){
        this.events();
    }

    events(){
        // get the delete button
        const deleteTheNote = document.querySelector(".delete-note");
        deleteTheNote.addEventListener('click', (e) => {
            this.deleteNote(e)
        })
    }

    // methods will go here
    async deleteNote(e){
       //delete functionality will come here
       try {
        const noteId = e.target.getAttribute('data-id');
        const postUrl =  universityData.archive_routes.root_url+`/wp-json/wp/v2/note/${noteId}`;

         const res = await axios.delete(postUrl, {
            headers:{
                'X-WP-Nonce': universityData.archive_routes.nonce
            }
        });        
        

        noteId.remove();

        if(res){
          console.log(e.target);

          console.log("Sucess Deleted",res);
        }
        
       } catch (error) {
         console.log(error);
       }

       const res = await axios.get(postUrl);
       console.log(res);
        
    };


}

export default MyNotes;