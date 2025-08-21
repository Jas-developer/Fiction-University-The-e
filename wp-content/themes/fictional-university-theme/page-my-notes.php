<?php

// if user is not logged in / redirect to frontpage  
 if(!is_user_logged_in()){
    wp_redirect(esc_url( home_url( '/' ) ));
    exit();
 }


//header
  get_header();

  while(have_posts()){
    the_post();
    pageBanner(); ?> 
    
    <div class="container container--narrow page-section">

       <div class="create-note">
         <h2 class="headline headline--medium">Create New Note</h2>
         <input type="text"  class="new-note-title" placeholder="Title">
         <textarea name="" id="" class="new-note-body" placeholder="Your note here..."></textarea>
         <button  class="submit-note">
            Create Note
         </button>
       </div> 


       <ul class="min-list link-list" id="my-notes">
           <?php 
            //query from wp db
            $userNotes = new WP_Query(
                [
                    'post_type' => 'note',
                    'posts_per_page' => -1,
                    'author' => get_current_user_id(),
                    'orderby'  => 'date',
                    'order'    => 'DESC'
                ]
            );

            while($userNotes->have_posts()){
                $userNotes->the_post(); ?>
                <li class="note-card "  data-id="<?php echo get_the_ID()?>" >
                    <input readonly class="note-title-field" type="text" value="<?php echo  str_replace("Private: ", "",esc_attr(get_the_title()) ) ?>">
                    <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span>
                    <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
                    <textarea readonly class="note-body-field"><?php echo esc_attr(wp_strip_all_tags( get_the_content())) ?></textarea>
                    <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i>Save</span>
                </li>
           <?php
        }
           ?>
       </ul>
    </div>
        

  <?php }
// footer |
   get_footer();
?>