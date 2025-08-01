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
            echo $get__title; ?></p>  
      </div>
    </div>
  </div>
  <div class="container container--narrow page-section">
     <div class="generic-content">
       <di class="row group"> 
        <div class="one-third">
           <?php  the_post_thumbnail('professorPortrait'); ?>
        </div>
        <div class="tow-thirds">
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