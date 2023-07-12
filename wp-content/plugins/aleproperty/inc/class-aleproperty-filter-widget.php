<?php

class aleProperty_Filter_Widget extends WP_Widget {

  function __construct(){
    parent::__construct('aleproperty_filter_widget', esc_html__('Filter','aleproperty'), array('description'=>'Filter Form'));
  }

  public function widget($args,$instance){
    extract($args);

    $title = apply_filters('widget_title',$instance['title']);
    $location = apply_filters('widget_title',$instance['location']);
    $type = apply_filters('widget_title',$instance['type']);
    $price = apply_filters('widget_title',$instance['price']);
    $offer = apply_filters('widget_title',$instance['offer']);
    $agent = apply_filters('widget_title',$instance['agent']);

    echo $before_widget;

    if($title) {
      echo $before_title . esc_html($title) . $after_title;
    }

    $fields = '';
    if ($location) {
      $fields .= ' location="1" ';
    }
    if ($type) {
      $fields .= ' type="1" ';
    }
    if ($price) {
      $fields .= ' price="1" ';
    }
    if ($offer) {
      $fields .= ' offer="1" ';
    }
    if ($agent) {
      $fields .= ' agent="1" ';
    }

    echo do_shortcode('[aleproperty_filter'. $fields .']');

    echo $after_widget;
  }

  public function form($instance) { 
    
    if (isset($instance['title'])){
      $title = $instance['title'];
    } else {
      $title = '';
    }
    if (isset($instance['location'])){
      $location = $instance['location'];
    } else {
      $location = '';
    }
    if (isset($instance['type'])){
      $type = $instance['type'];
    } else {
      $type = '';
    }    
    if (isset($instance['price'])){
      $price = $instance['price'];
    } else {
      $price = '';
    }
    if (isset($instance['offer'])){
      $offer = $instance['offer'];
    } else {
      $offer = '';
    }
    if (isset($instance['agent'])){
      $agent = $instance['agent'];
    } else {
      $agent = '';
    }
    
    ?>

  <p>
    <label for="<?php $this->get_field_id('title'); ?>"><?php esc_html__('Title'); ?></label>
    <input class="widefat" type="text" id="<?php $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
  </p>
  <p>
    <label for="<?php $this->get_field_id('location'); ?>"><?php echo esc_html__('Show Location Fields'); ?></label>
    <input type="checkbox" name="<?php echo $this->get_field_name('location'); ?>" id="<?php $this->get_field_id('location'); ?>" <?php checked($location, 'on'); ?>>
  </p>
  <p>
    <label for="<?php $this->get_field_id('type'); ?>"><?php echo esc_html__('Show Type Fields'); ?></label>
    <input type="checkbox" name="<?php echo $this->get_field_name('type'); ?>" id="<?php $this->get_field_id('type'); ?>" <?php checked($type, 'on'); ?>>
  </p>
  <p>
    <label for="<?php $this->get_field_id('price'); ?>"><?php echo esc_html__('Show Price Fields'); ?></label>
    <input type="checkbox" name="<?php echo $this->get_field_name('price'); ?>" id="<?php $this->get_field_id('price'); ?>" <?php checked($price, 'on'); ?>>
  </p>
  <p>
    <label for="<?php $this->get_field_id('offer'); ?>"><?php echo esc_html__('Show Offer Fields'); ?></label>
    <input type="checkbox" name="<?php echo $this->get_field_name('offer'); ?>" id="<?php $this->get_field_id('offer'); ?>" <?php checked($offer, 'on'); ?>>
  </p>
  <p>
    <label for="<?php $this->get_field_id('agent'); ?>"><?php echo esc_html__('Show Agent Fields'); ?></label>
    <input type="checkbox" name="<?php echo $this->get_field_name('agent'); ?>" id="<?php $this->get_field_id('agent'); ?>" <?php checked($agent, 'on'); ?>>
  </p>
  <?php
  }

  public function update($new_instance,$old_instance){
    $instance = $old_instance;

    $instance['title'] = strip_tags($new_instance['title']);
    $instance['location'] = strip_tags($new_instance['location']);
    $instance['type'] = strip_tags($new_instance['type']);
    $instance['price'] = strip_tags($new_instance['price']);
    $instance['offer'] = strip_tags($new_instance['offer']);
    $instance['agent'] = strip_tags($new_instance['agent']);


    return $instance;
  }
}