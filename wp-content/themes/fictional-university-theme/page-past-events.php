<?php
get_header();

pageBanner(
  [
  'title' => get_the_title(),
  'subtitle' => 'Recap of our past Events!'
  ]
);
?>

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
   $past_events-> the_post();
   get_template_part('template-parts/content', 'event');
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
