import axios from "axios";


class MyNotes {
    constructor(){
        this.events();
    }

    events(){
        //Delete a Note Event Listener
        const deleteTheNote = document.querySelectorAll(".delete-note");
        deleteTheNote.forEach(delNote => {
            delNote.addEventListener('click', (e) => {
            this.deleteNote(e)
            })
        });
        //Edit a Note Event Listener
        const editTheNote = document.querySelectorAll('.edit-note');
        editTheNote.forEach(editNote => {
            editNote.addEventListener('click', (e) => {
            this.EditNote(e);
            });
        });



    }

    // Edit Note Method Passed as a CallBack Function for the Event Listener
    async EditNote(e){
       try {
        const parentCard = e.target.closest('.note-card');
        const noteId = parentCard.getAttribute('data-id');

        /*
         *Access Save Button Element, Remove Ready only Attr for Input & Textarea And Add  Active class for styling when .edit-note element clicked
         *Replace Edit Button by Cancel Button after Clicked
        */
        
        const editNoteTitleAndBody = () => {
            // Input Element
            const inputElement = parentCard.querySelector('.note-title-field');
            inputElement.classList.add('note-active-field');
            inputElement.removeAttribute('readonly');
            // TextArea Element
            const TextAreaElement = parentCard.querySelector(".note-body-field");
            TextAreaElement.classList.add('note-active-field');
            TextAreaElement.removeAttribute('readonly')
            // Save Button
            parentCard.querySelector('.update-note').classList.add('update-note--visible');

            /*
            *Edit & Cancel Button
            *Replaced EDIT Button with CANCEL button when its clicked
            */
            const spanElement = parentCard.querySelector('.edit-note');
            spanElement.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i> Cancel';
        }
        // called the function
        editNoteTitleAndBody();
       
        
        

    

        const postUrl =  universityData.archive_routes.root_url+`/wp-json/wp/v2/note/${noteId}`;
         
        




       } catch (error) {
         const errorMessage = error.message ? error.message : "Something Went Wrong";
         console.log(errorMessage);
       } 
    }
   

    // Delete Note Method Passed as a callback function for The Event Listener
    async deleteNote(e){
       try {
        const parentCard = e.target.closest('.note-card');
        const noteId = parentCard.getAttribute('data-id');
       
        const postUrl =  universityData.archive_routes.root_url+`/wp-json/wp/v2/note/${noteId}`;

        const res = await axios.delete(postUrl, {
            headers:{
                'X-WP-Nonce': universityData.archive_routes.nonce
            }
        });        
        
        //return object for frontend user
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

// ending curly braces
}

export default MyNotes;