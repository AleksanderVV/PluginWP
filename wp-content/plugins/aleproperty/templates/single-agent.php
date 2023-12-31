<?php 
get_header();
?>

<div class="wrapper single_property">

  <?php
  if (have_posts()) {
    while(have_posts()){
      the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php if(get_the_post_thumbnail(get_the_ID(),'large')){
        echo get_the_post_thumbnail(get_the_ID(),[400,400]);
      } ?>
        <h2><?php the_title(); ?></h2>
        <div class="description"><?php the_content(); ?></div>
      </article>

  <?php
    }
  }
  ?>
</div>

<?php
get_footer();