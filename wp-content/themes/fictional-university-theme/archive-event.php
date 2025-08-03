<?php
get_header();

pageBanner(
  [
    'title' => 'Welcome to our Events',
    'subtitle' => 'See daily updates on our world!s',
    'photo' => get_theme_file_uri( '/images/ocean.jpg' )
  ]
)
?>
<div class="container container--narrow page-section">
<?php

 while(have_posts(  )){
    the_post(); ?>
     <div class="event-summary">
            <a class="event-summary__date t-center" href="<?php the_permalink(  )?>">
              <span class="event-summary__month"><?php
               $event__date = get_field('event_date');
               $event = new DateTime($event__date);
               echo $event->format('M');
              ?></span>
              <span class="event-summary__day"><?php echo $event->format('d'); ?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php  the_permalink(  ) ?>"><?php the_title( ) ?></a></h5>
              <p><?php if(has_excerpt() ){ echo get_the_excerpt(); } else{ echo wp_trim_words(get_the_content(), 18); } ?> <a href="<?php  the_permalink(  ) ?>" class="nu gray">Learn more</a></p>
        </div>
    </div>
<?php 
 }
 echo paginate_links(  );
 ?>
 <br>
 <p>Looking for a recap of past events? <a href="<?php echo home_url('/past-events') ?>">Check out our past events archive.</a></p>
</div>
<?php 
get_footer();
?>
