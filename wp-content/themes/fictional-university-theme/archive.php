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
      ?> This is Archive Page</h1>
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
    <div class="post-item">
      <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink( ) ?>"><?php the_title( ) ?></a></h2>
      <div class="metabox">
        <p>Posted by <?php the_author_posts_link(  )?> on <?php the_time('M.j.Y' ) ?> in <?php echo get_the_category_list(', '  )  ?></p>
      </div>

      <div class="generic-content">
        <?php the_excerpt(  ) ?>
        <p><a href="<?php the_permalink() ?>" class="btn btn--blue">
           Continue reading &raquo;
        </a>
        </p>
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
