<?php

get_header();

while (have_posts()) {
  the_post(); 
  ?>
  
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(images/ocean.jpg)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>PLEASE CHANGE ME LATER.</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">

    <?php
    $current_page_id = get_the_ID(); //current page id
    $parent_id = wp_get_post_parent_id($current_page_id); // find the parent of this current id

    if ($parent_id != 0) {
      ?>

      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_permalink($parent_id); ?>">
            <i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title( $parent_id ); ?>

          </a>
          <span class="metabox__main">
            <?php the_title(); ?>
          </span>
        </p>
      </div>

    <?php } ?>
    

  <div class="page-links">

    <?php 
      // display the sidebar regardless
      if($parent_id) //check if there is a parent / if this is current a child post/page
      { $findChildrenOf =  $parent_id;}
      else // if you are on a parent page
      { $findChildrenOf = get_the_ID(); }?>

    <h2 class="page-links__title">
      <a href="<?php echo get_permalink($findChildrenOf ); ?>">
      <?php echo get_the_title( $findChildrenOf ); ?>
      </a>
    </h2>
    <ul class="min-list">
    <?php 
      wp_list_pages(array(
        'title_li' => null,
        'sort_column' => 'menu_order',
        'child_of' => $findChildrenOf
      )); 

    ?>
    </ul>
  </div>
    <div class="generic-content">
      <?php the_content(); ?>
    </div>
  </div>
<?php 
}

get_footer();

?>
