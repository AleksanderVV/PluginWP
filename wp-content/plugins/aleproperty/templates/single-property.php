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
        echo get_the_post_thumbnail(get_the_ID(),'large');
      } ?>

        <?php 
        $price = get_post_meta(get_the_ID(),'aleproperty_price',true);

        $locations = get_the_terms(get_the_ID(),'location');
        $ale_location = '';
        foreach($locations as $location) {
          $ale_location .= ' '.$location->name;
        }

        $ale_title = get_the_title();

        do_shortcode('[aleproperty_booking price="'.$price.'" location="'.$ale_location.'" title="'.$ale_title.'"]'); ?>



        <h2><?php echo $ale_title; ?></h2>
        <div class="description"><?php the_content(); ?></div>
        <div class="property_info">
          <p class="location"><?php esc_html_e('Location:','aleproperty');
          
          echo $ale_location;
          ?></p>
          <p class="type"><?php esc_html_e('Type:','aleproperty');
          
          $types = get_the_terms(get_the_ID(),'property-type');
          foreach($types as $type) {
            echo ' '.$type->name;
          }
          ?></p>
          <p class="price"><?php esc_html_e('Price:','aleproperty'); echo ' '. $price; ?></p>
          <p class="offer"><?php esc_html_e('Offer:','aleproperty'); echo ' '.get_post_meta(get_the_ID(),'aleproperty_type',true); ?></p>
          <p class="agent"><?php esc_html_e('Agent:','aleproperty'); 
          
              $agent_id = get_post_meta(get_the_ID(),'aleproperty_agent',true);
              $agent = get_post($agent_id);
              echo ' '.esc_html__($agent->post_title);
          ?></p>
        </div>
      </article>

  <?php
    }
  }
  ?>
</div>

<?php
get_footer();