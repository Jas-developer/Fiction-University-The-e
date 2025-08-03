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

    the_post();
    get_template_part( 'template-parts/content', 'event' );
    
 }
 echo paginate_links(  );
 ?>
 <br>
 <p>Looking for a recap of past events? <a href="<?php echo home_url('/past-events') ?>">Check out our past events archive.</a></p>
</div>
<?php 
get_footer();
?>
