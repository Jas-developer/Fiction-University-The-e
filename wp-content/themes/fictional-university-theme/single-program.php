<?php

get_header();

while(have_posts()){
   the_post( ); ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri( 'images/ocean.jpg' ) ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p><?php 
         $event__date = get_field('event_date');
         
         $event =  new DateTime($event__date);
        ?> <p>We're so excited to meet you!</p>  <?
         echo $event->format('F, j, Y')
        ?></p>
      </div>
    </div>
  </div>
  <div class="container container--narrow page-section">
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo  get_post_type_archive_link('program') ?>">
            <i class="fa fa-home" aria-hidden="true"></i>All Program
          </a>
          <span class="metabox__main">
           <?php the_title(  ) ?>
          </span>
        </p>
      </div>
     <div class="generic-content">
      <p>
      <?php the_content(); ?>
      </p>
     </div>
     <?php
     
    $professorQuery = [
      'post_type' => 'professor',
      'posts_per_page' => -1,
      'orderby' => 'title',
      'order' => 'ASC',
      'meta_query' => array(
        array(
        'key' => 'related_programs',
        'compare' => 'LIKE',
        'value' => '"'.get_the_ID().'"'
       )
      )
    ];
    // wp query object
    $relatedProfessors = new WP_Query($professorQuery);
    
    if($relatedProfessors->have_posts()){
      
      echo '<hr class="section-break"/>';
    echo '<h2 class="headline headline--medium">'.get_the_title().' Professors</h2>';
    // the loop

    echo '<ul class="professor-cards">';
    while($relatedProfessors->have_posts()){
      $relatedProfessors->the_post();
     ?>
     <li class="professor-card__list-item">
     <a class="professor-card" href="<?php the_permalink() ?>">
      <img src="<?php echo get_the_post_thumbnail_url() ?>"  class='professor-card__image'>
      <span class="professor-card__name">
        <?php the_title(  )?>
      </span>
    </a></li>
    <?php }

    echo '</ul>';
    }
      wp_reset_postdata();
    
     ?>
  <?php 

    $today = date('Ymd');
    $custom_post_parameter = [
      'post_type' => 'event',
      'posts_per_page' => -1,
      'meta_key' => 'event_date',
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_query' => array(
       array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
       ), array(
        'key' => 'related_programs',
        'compare' => 'LIKE',
        'value' => '"'.get_the_ID().'"'
       )
      )
    ];
    // wp query object
    $custom_query = new WP_Query($custom_post_parameter);
    if($custom_query->have_posts()){

      echo '<hr class="section-break"/>';
    echo '<h2 class="headline headline--medium"> Upcoming '.get_the_title().' Events</h2>';
    while($custom_query->have_posts()){
      $custom_query->the_post();
     ?>
    <div class="event-summary">
            <a class="event-summary__date t-center" href="#">
              <span class="event-summary__month"><?php

               $event__date = get_field('event_date');

               $event = new DateTime($event__date);
               echo $event->format('M');

              ?></span>
              <span class="event-summary__day"><?php echo $event->format('d'); ?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny">
                <a href="<?php  the_permalink() ?>"><?php the_title( ) ?></a></h5>
              <p><?php if(has_excerpt() ){ echo get_the_excerpt(); } 
              else{ echo wp_trim_words(get_the_content(), 18); } ?> 
              <a href="<?php  the_permalink(  ) ?>" class="nu gray">Learn more</a></p>
            </div>
          </div>
<?php }
    }
     ?>
  </div>
   <?php } 
   get_footer();
   
?>