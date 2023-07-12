<?php 

class aleProperty_Shortcodes {

  public $aleProperty;
  public $agents;

  public function register(){
    add_action('init', [$this,'register_shortcode']);
  }

  public function register_shortcode() {
    add_shortcode('aleproperty_filter',[$this, 'filter_shortcode']);
  }

  public function filter_shortcode($atts = array(), $content = null) {
    extract(shortcode_atts(array(
      'location' => 0,
      'type' => 0,
      'offer' => 0,
      'price' => 0,
      'agent' => 0
    ),$atts));

    $this->aleProperty = new aleProperty();
    $this->agents = get_posts(array('post_type' => 'agent', 'numberposts' => -1));

    $agents_list = '';
    foreach ($this->agents as $person) {
      $agents_list .= '<option value="'.$person->ID.'">'. $person->post_title .'</option>';
    }

    $output = '';
    $output .= '<div class="wrapper filter_form">';
    $output .= '<form action="'.get_post_type_archive_link('property').'" method="POST">';

    if ($location == 1) {
      $output .= '
        <select name="aleproperty_location">
          <option value="">'. esc_html__('Select Location','aleproperty') .'</option>
          '.$this->aleProperty->get_terms_hierarchical('location','') .'
        </select>
      ';
    }

    if ($type == 1) {
      $output .= '
        <select name="aleproperty_property-type">
          <option value="">'. esc_html__('Select Type','aleproperty') .'</option>
          '.$this->aleProperty->get_terms_hierarchical('property-type', '') .'
        </select>
      ';
    }

    if ($price == 1) {
      $output .= '
        <input type="text" placeholder="'. esc_html__('Max Price','aleproperty') .'" name="aleproperty_price" 
        value="">
      ';
    }

    if ($offer == 1) {
      $output .= '
        <select name="aleproperty_type" id="aleproperty_type">
          <option value="">'. esc_html__('Select Offer','aleproperty') .'</option>
          <option value="sale">'. esc_html__('For Sale','aleproperty') .'</option>
          <option value="rent">'. esc_html__('For Rent','aleproperty') .'</option>
          <option value="sold">'. esc_html__('Sold','aleproperty') .'</option>
        </select>
      ';
    }

    if ($agent == 1) {
      $output .= '
        <select name="aleproperty_agent">
          <option value="">'. esc_html__('Select Agents','aleproperty') .'</option>'. $agents_list .'
        </select>
      ';
    }

    $output .= '
        <input type="submit" value="'. esc_html__('Filter','aleproperty') .'" name="submit">
    
    ';


    $output .= '</form>';
    $output .= '</div>';

    return $output;

  }
}

$aleProperty_Shortcode = new aleProperty_Shortcodes();
$aleProperty_Shortcode-> register();