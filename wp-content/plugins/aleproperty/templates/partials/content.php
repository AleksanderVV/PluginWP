<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php if(get_the_post_thumbnail(get_the_ID(),'large')){
        echo get_the_post_thumbnail(get_the_ID(),'large');
      } ?>
        <h2><?php the_title(); ?></h2>
        <div class="description"><?php the_excerpt(); ?></div>
        <div class="property_info">
          <p class="location"><?php esc_html_e('Location:','aleproperty');
          
              $locations = get_the_terms(get_the_ID(),'location');
              foreach($locations as $location) {
                echo ' '.$location->name;
              }
          ?></p>
          <p class="type"><?php esc_html_e('Type:','aleproperty');
          
          $types = get_the_terms(get_the_ID(),'property-type');
          foreach($types as $type) {
            echo ' '.$type->name;
          }
          ?></p>
          <p class="price"><?php esc_html_e('Price:','aleproperty'); echo ' '.get_post_meta(get_the_ID(),'aleproperty_price',true); ?></p>
          <p class="offer"><?php esc_html_e('Offer:','aleproperty'); echo ' '.get_post_meta(get_the_ID(),'aleproperty_type',true); ?></p>
          <p class="agent"><?php esc_html_e('Agent:','aleproperty'); 
          
              $agent_id = get_post_meta(get_the_ID(),'aleproperty_agent',true);
              $agent = get_post($agent_id);
              echo ' '.esc_html__($agent->post_title);
          ?></p>
        </div>
        <a href="<?php the_permalink();?>"> <?php esc_html_e('Open this Property'); ?> </a>
      </article>