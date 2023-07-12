<?php 
get_header();
?>

<?php $aleProperty_Template->get_template_part('partials/filter'); ?>

<div class="wrapper archive_property">

  <?php

  if(!empty($_POST['submit'])){

    $args = array(
      'post_type' => 'property',
      'post_per_page' => -1,
      'meta_query' => array('relation' => 'AND'),
      'tax_query' => array('relation' => 'AND')
    );

    if(isset($_POST['aleproperty_type']) AND $_POST['aleproperty_type'] != '') {
      array_push($args['meta_query'], array(
        'key' => 'aleproperty_type',
        'value' => esc_attr($_POST['aleproperty_type'])
      ));
    }
    if(isset($_POST['aleproperty_price']) AND $_POST['aleproperty_type'] != '') {
      array_push($args['meta_query'], array(
        'key' => 'aleproperty_price',
        'value' => esc_attr($_POST['aleproperty_price']),
        'type' => 'numeric',
        'compare' => '<='
      ));
    }
    if(isset($_POST['aleproperty_agent']) AND $_POST['aleproperty_type'] != '') {
      array_push($args['meta_query'], array(
        'key' => 'aleproperty_agent',
        'value' => esc_attr($_POST['aleproperty_agent']),
        'type' => 'numeric',
        'compare' => '<='
      ));
    }
    if(isset($_POST['aleproperty_location']) AND $_POST['aleproperty_location'] != '') {
      array_push($args['tax_query'], array(
        'taxonomy' => 'location',
        'terms' => $_POST['aleproperty_location']
      ));
    }
    if(isset($_POST['aleproperty_property-type']) AND $_POST['aleproperty_property-type'] != '') {
      array_push($args['tax_query'], array(
        'taxonomy' => 'property-type',
        'terms' => $_POST['aleproperty_property-type']
      ));
    }

    $properties = new WP_Query($args);

    if ($properties->have_posts()) {
      while($properties->have_posts()){
        $properties->the_post();
  
        $aleProperty_Template->get_template_part('partials/content');
  
      }
    }else{
      echo '<p>'. esc_html__("No Properties",'aleproperty').'<p>';
    }

  } else {

    if (have_posts()) {
      while(have_posts()){
        the_post();
  
        $aleProperty_Template->get_template_part('partials/content');
  
      }
      //Pagination
      posts_nav_link();
    }else{
      echo '<p>'. esc_html__("No Properties",'aleproperty').'<p>';
    }

  }

  ?>
</div>

<?php

get_footer();