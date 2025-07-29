<?php
get_header();
?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri( 'images/ocean.jpg' ) ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php
      if (is_category(  )){
          single_cat_title();
      }else if (is_author(  )){
       echo 'Posted by '; the_author() ;
      };
      ?> Welcome to Our Events</h1>
      <div class="page-banner__intro">
        <p><?php the_archive_description() ?></p>
      </div>
    </div>
  </div>
<!-- display contents -->
<div class="container container--narrow page-section">
<?php
 while(have_posts(  )){
    the_post(); ?>
     <div class="event-summary">
               <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink( ) ?>">
                <span class="event-summary__month"><?php 
                $event__date = get_field('event_date');
                $event = new DateTime($event__date);
                //echo the mont abbreviation
                echo $event->format('M');
                ?></span>
                <span class="event-summary__day"><?php echo $event->format('d'); ?></span>
               </a>
               <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink( )?>"><?php the_title( ) ?></a></h5>
                <p><?php  echo wp_trim_words(get_the_content(   ), 18,'...')?> <a href="<?php the_permalink(  )?>" class="nu gray">Read more</a></p>
               </div>
          </div>
<?php 
 }
 
 echo paginate_links(  );


 ?>
</div>
<?php 
get_footer();
?>
