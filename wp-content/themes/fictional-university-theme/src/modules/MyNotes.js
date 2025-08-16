import axios from "axios";


class MyNotes {
    constructor(){
        this.events();
    }

    events(){
        //delete a note
        const deleteTheNote = document.querySelectorAll(".delete-note");
        deleteTheNote.forEach(delNote => {
            delNote.addEventListener('click', (e) => {
            this.deleteNote(e)
            console.log("Deleted some shit");
            console.log(e.target.closest('.note-card'))
            })
        });
    }

    // methods will go here
    async deleteNote(e){
       //delete functionality will come here
       try {
        const parentCard = e.target.closest('.note-card');
        const noteId = parentCard.getAttribute('data-id');
        // access card

    
        //api
        const postUrl =  universityData.archive_routes.root_url+`/wp-json/wp/v2/note/${noteId}`;

        const res = await axios.delete(postUrl, {
            headers:{
                'X-WP-Nonce': universityData.archive_routes.nonce
            }
        });        
        
        if(res.statusText === 'OK'){
           parentCard.classList.add("hide-note-card");

           const results = {
               Title: res.data.title.rendered,
               Id: res.data.id,
               StatusCode: res.status,
               StatusText: res.statusText
           }
           console.log(results);
          
        }
        
        
       } catch (error) {
         console.log(error );
       }

        
    };


}

export default MyNotes;