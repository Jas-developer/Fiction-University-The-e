import $ from 'jquery';

class Search {
    // describe and create our object
    constructor(){
       this.resultsDiv = $("#search-overlay__results");
       this.openButton = $('.js-search-trigger');
       this.closeButton = $('.search-overlay__close');
       this.searchOverlay = $('.search-overlay') ;
       this.searchField = $('#search-term');
       this.events();
       this.isOverlayOpen =  false;
       this.typingTimer;
       this.previousValue;
    }

    // events
    events() {
        this.openButton.on('click',  this.openOverlay.bind(this));
        this.closeButton.on('click',this.closeOverlay.bind(this));
        $(document).on('keydown', this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup",this.typingLogic.bind(this));
    }

    typingLogic(){

        clearTimeout(this.typingTimer);
        if(this.resultsDiv.find('.spinner-loader').length === 0 
           && this.previousValue != this.searchField.val() ){
            
            this.resultsDiv.html('<div class="spinner-loader"></div>');

             this.typingTimer = setTimeout(() =>
            {
              this.resultsDiv.html('This is a sample search results');
            }
        ,2000);
        }
        
       

        this.previousValue = this.searchField.val();
    }


    openOverlay(){
        this.searchOverlay.addClass('search-overlay--active');
        $('body').addClass('body-no-scroll');
        console.log("Our open method just run");
        this.isOverlayOpen = true;
    }
    closeOverlay(){
        this.searchOverlay.removeClass('search-overlay--active');
        $('body').removeClass('body-no-scroll');
        this.isOverlayOpen = false;
    }
    keyPressDispatcher(e){
        if(e.keyCode == 83 && this.isOverlayOpen == false){
            this.openOverlay();
        }
        
        if(e.keyCode == 27 && this.isOverlayOpen == true){
            this.closeOverlay();
        }

    }
}



export default Search;