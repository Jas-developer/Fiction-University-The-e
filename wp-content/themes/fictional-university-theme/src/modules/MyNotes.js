
class MyNotes {
    constructor(){
        this.events();
    }

    events(){
        // get the delete button
        const deleteTheNote = document.querySelector(".delete-note");
        deleteTheNote.addEventListener('click', () => this.deleteNote())
    }

    // methods will go here
    deleteNote(){
        alert('Are you sure you want this to delete?')
    }
}

export default MyNotes;