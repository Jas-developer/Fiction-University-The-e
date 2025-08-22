<?php

get_header();
while(have_posts()){
   the_post( ); ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php 
    $get__image = get_field('page_banner_background_image');
    if($get__image){
     echo $get__image['sizes']['pageBanner'];
    }else{
      echo get_theme_file_uri( 'images/ocean.jpg' );
    }

     ?>)">
    </div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p><?php  $get__title = get_field('page_banner_subtitle');
            if($get__title){
              echo $get__title;
            }else{
              echo 'Welcome to our program!';
            } ?></p>  
      </div>
    </div>
  </div>
  <div class="container container--narrow page-section">
     <div class="generic-content">
       <di class="row group"> 
        <div class="one-third">
           <?php  the_post_thumbnail('professorPortrait'); ?>
        </div>
        <div class="two-thirds">
          <?php
           
           $likeCount = new WP_Query(array(
            'post_type' => 'like',
            'meta_query' => array(array(
                  'key' => 'like_professor_id',
                  'compare' => '=',
                  'value' => get_the_ID()
            ))
           ));


           $likeCount = new WP_Query(array(
            'post_type' => 'like',
            'meta_query' => array(array(
                  'key' => 'like_professor_id',
                  'compare' => '=',
                  'value' => get_the_ID()
            ))
           ));

           $existStatus = 'no';

           $existQuery  = new WP_Query(array(
            'author' => get_current_user_id(  ),
            'post_type' => 'like',
            'meta_query' => array(array(
                  'key' => 'like_professor_id',
                  'compare' => '=',
                  'value' => get_the_ID()
            ))
           ));

           if($existQuery->found_posts > 0){
              $existStatus = 'yes';
           };



          
          ?>
           <span class="like-box" test-res="rest na" data-exists="<?php echo $existStatus ?>">
            <i class="fa fa-heart-o" aria-hidden="true"></i>
            <i class="fa fa-heart" aria-hidden="true"></i>
            <span class="like-count">
              <?php echo $likeCount->found_posts;  ?>
            </span>
           </span>
           <?php  the_content(); ?>
        </div>
      </di>
  </div>
     <?php 
     $relatedPrograms = get_field('related_programs');
    if(!empty($relatedPrograms)){
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium"> Subjects(s) Taught!</h2>';
      echo '<ul class="link-list min-list" >';
      foreach($relatedPrograms as $program){ ?>
          <li><a href="<?php echo get_the_permalink($program) ?>">
            <?php echo get_the_title( $program ) ?>
          </a></li>
      <?php };
      echo '</ul>';
    }
     ?>
  </div>
<br>
   <?php } 
   get_footer();
   
?>