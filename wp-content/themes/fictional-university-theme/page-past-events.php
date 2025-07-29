<?php
get_header();
?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri( 'images/ocean.jpg' ) ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
      <?php the_title() ?></h1>
      <div class="page-banner__intro">
        <p> Recap of Our Past Events</p>
      </div>
    </div>
  </div>
<!-- display contents -->
<div class="container container--narrow page-section">
<?php
// declare the date
$today = date('Ymd');
$past_events_param = array(
  'paged' => get_query_var('paged',1), // i will tell the wordpress the current page number
  'post_type'      => 'event',
  'meta_key'       => 'event_date',
  'orderby'        => 'meta_value_num',
  'order'          => 'ASC',
  'meta_query'     => array (
      'key'     => 'event_date',
      'value'   => $today, // ← This is important!
      'compare' => '<=',
      'type'    => 'numeric'
  )
);


$past_events = new WP_Query($past_events_param);
 while($past_events->have_posts(  )){
   $past_events-> the_post(); ?>
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
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php  the_permalink(  ) ?>"><?php the_title( ) ?></a></h5>
              <p><?php if(has_excerpt() ){ echo get_the_excerpt(); } else{ echo wp_trim_words(get_the_content(), 18); } ?> <a href="<?php  the_permalink(  ) ?>" class="nu gray">Learn more</a></p>
        </div>
    </div>
<?php 
 }
$pagination = paginate_links(array(
  'total'     => $past_events->max_num_pages,
  'prev_text' => '« Prev',
  'next_text' => 'Next »',
  'type'      => 'array', // so we can loop and style each item
));

if ($pagination) {
  echo '<div style="display:flex; flex-wrap:wrap; gap:6px; justify-content:center; margin-top:30px;">';

  foreach ($pagination as $page) {
    // Highlight the current page
    if (strpos($page, 'current') !== false) {
      echo str_replace(
        'page-numbers current',
        '',
        str_replace(
          '<span',
          '<span style="padding:8px 14px; background:#0073aa; color:#fff; border-radius:4px; font-weight:bold; text-decoration:none; display:inline-block;"',
          $page
        )
      );
    } else {
      echo str_replace(
        'page-numbers',
        '',
        str_replace(
          '<a',
          '<a style="padding:8px 14px; background:#e4e4e4; color:#333; border-radius:4px; text-decoration:none; display:inline-block;"',
          $page
        )
      );
    }
  }

  echo '</div>';
}
?>
</div>
<?php 
get_footer();
?>
