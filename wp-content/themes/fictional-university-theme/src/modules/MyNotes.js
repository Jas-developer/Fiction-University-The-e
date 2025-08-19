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
        //Update a Note Event Listener
        const updateTheNote = document.querySelectorAll('.update-note');
        updateTheNote.forEach((updateNote) => {
           updateNote.addEventListener('click', (e) => {
            this.UpdateNote(e)
           })
        });

        // Create a Note Event Listener
        const createTheNote = document.querySelector('.submit-note');
        createTheNote.addEventListener('click', (e) => {
                if(!createTheNote.closest(".create-note").querySelector('.new-note-title').value == "" &&
                   !createTheNote.closest(".create-note").querySelector('.new-note-body').value == ""
                  ){
                 this.createNote(e);
                } 
            }
        )

    }
    
    //Create / Submit a Note
    async createNote(e){
        
     try {

        const parentCard = e.target.closest('.create-note');
        const bodyValue = parentCard.querySelector('.new-note-body').value;
        const titleValue = parentCard.querySelector('.new-note-title').value;
        
        
        const noteData = {
            title: titleValue,
            content: bodyValue,
            status: "publish"
        }

        
        const postUrl =  universityData.archive_routes.root_url+`/wp-json/wp/v2/note`;
        
        // Sending updated data / Updating data
        const res = await axios.post(postUrl, noteData,{ headers:{ 'X-WP-Nonce': universityData.archive_routes.nonce } }); 

        if(res.status === 201 || res.status === 200){
           console.log('Created note successfully')
           parentCard.querySelector(".new-note-title").value = "Succes a new Note is submitted ";
           parentCard.querySelector(".new-note-body").value = " ";
           setTimeout(() => {
           window.location.reload();
           }, 300); // 0.3 sec

        } else {
          throw new Error("Failed to create a note or data")
        }

        console.log(res)
            
        } catch (error) {
            console.log(error.message ? error.message : "Something wen wrong");
        }

        
    }

  






    //Update Note Method Passed as a CallBack Function for the Event Listener
    async UpdateNote(e){

        try {
            
        const parentCard = e.target.closest(".note-card");
        const noteId = parentCard.getAttribute('data-id');
       

        // our updated value
        const titleValue = parentCard.querySelector('.note-title-field').value;
        const bodyValue = parentCard.querySelector('.note-body-field').value;

        const updatedValue = {
            title: titleValue,
            content: bodyValue
        }
        
        const postUrl =  universityData.archive_routes.root_url+`/wp-json/wp/v2/note/${noteId}`;
        
        // Sending updated data / Updating data
        const res = await axios.post(postUrl, updatedValue,
            {
                 headers:{
                'X-WP-Nonce': universityData.archive_routes.nonce
                 }
            }
        )
        

        console.log(res.data)


        // close the button after clicking save
        const SaveUpdate = () => {
            // Input Element
            const inputElement = parentCard.querySelector('.note-title-field');
            inputElement.classList.remove('note-active-field');
            inputElement.setAttribute('readonly', true);
            // TextArea Element
            const TextAreaElement = parentCard.querySelector(".note-body-field");
            TextAreaElement.classList.remove('note-active-field');
            TextAreaElement.setAttribute('readonly', true)
            // Save Button
            parentCard.querySelector('.update-note').classList.remove('update-note--visible');

            /*
            *Edit & Cancel Button
            *Replaced EDIT Button with CANCEL button when its clicked
            */
            const spanElement = parentCard.querySelector('.edit-note');
            spanElement.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i> Edit';
            spanElement.setAttribute('data-state', 'noteditable'); 
        }
        
        SaveUpdate();
            
        } catch (error) {
          console.log(error.message ? error.message : "Something went Wrong") 
        }
    }







    // Edit Note Method Passed as a CallBack Function for the Event Listener
    async EditNote(e) {

        const parentCard = e.target.closest('.note-card');
       
        
        if(parentCard.querySelector('.edit-note').dataset.state != 'editable'){
          parentCard.querySelector('.edit-note').setAttribute('data-state', 'editable');   
        }else{
          parentCard.querySelector('.edit-note').setAttribute('data-state', 'noteditable');  
        }
      
        /*
         *Access Save Button Element, Remove Ready only Attr for Input & Textarea And Add  Active class for styling when .edit-note element clicked
         *Replace Edit Button by Cancel Button after Clicked
        */

        const editingNoteMode = () => {
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
        
       
        
        const cancelNoteEditingMode = () => {
            // Input Element
            const inputElement = parentCard.querySelector('.note-title-field');
            inputElement.classList.remove('note-active-field');
            inputElement.setAttribute('readonly', true);
            // TextArea Element
            const TextAreaElement = parentCard.querySelector(".note-body-field");
            TextAreaElement.classList.remove('note-active-field');
            TextAreaElement.setAttribute('readonly', true)
            // Save Button
            parentCard.querySelector('.update-note').classList.remove('update-note--visible');

            /*
            *Edit & Cancel Button
            *Replaced EDIT Button with CANCEL button when its clicked
            */
            const spanElement = parentCard.querySelector('.edit-note');
            spanElement.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i> Edit';
        }

        // Display note depending on state attribute value
        if(parentCard.querySelector('.edit-note').dataset.state == 'editable'){
           editingNoteMode()
          }else{
           cancelNoteEditingMode();
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