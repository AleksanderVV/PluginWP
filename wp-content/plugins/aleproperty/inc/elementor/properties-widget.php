<?php

class Elementor_Properties_Widget extends \Elementor\Widget_Base {

  protected $aleProperty_Template;

  protected $aleLocations = array();

	public function get_name() {
		return 'aleproperties';
	}

	public function get_title() {
		return esc_html__( 'Properties List', 'aleproperty' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'aleproperty' ];
	}

	protected function register_controls() {

    $temp_locations = get_terms('location');

    foreach($temp_locations as $location){
      $this->aleLocations[$location->term_id] = $location->name;
    }
    $this->aleLocations['0'] = 'Select locations';

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'aleproperty' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'count',
			[
				'label' => esc_html__( 'Post count', 'aleproperty' ),
				'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 3
			]
		);

    $this->add_control(
			'offer',
			[
				'label' => esc_html__( 'Offer', 'aleproperty' ),
				'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '',
        'options' => array(
          '' => esc_html__( 'Select Offer', 'aleproperty' ),
          'sale' => esc_html__('For Sale', 'aleproperty'),
          'rent' => esc_html__('For Rent', 'aleproperty'),
          'sold' => esc_html__('Sold', 'aleproperty'),
        )
			]
		);

    $this->add_control(
			'locations',
			[
				'label' => esc_html__( 'Location', 'aleproperty' ),
				'type' => \Elementor\Controls_Manager::SELECT,
        'default' => '0',
        'options' => $this->aleLocations
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
    
    $args = array(
      'post_type' => 'property',
      'posts_per_page' => $settings['count'],
      'meta_query' => array('relation' => 'AND'),
      'tax_query' => array('relation' => 'AND')
    );

    if(isset($settings['offer']) && $settings['offer'] != ''){
      array_push($args['meta_query'], array(
        'taxonomy' => 'property_type',
        'value' => esc_attr($settings['offer'])
      ));
    }
    if(isset($settings['locations']) AND $settings['locations'] != '') {
      array_push($args['tax_query'], array(
        'taxonomy' => 'location',
        'terms' => $settings['locations']
      ));
    }

    $propreties = new WP_Query($args);

    $this->aleProperty_Template = new aleProperty_Template_Loader();

    if ($propreties->have_posts()) {
      echo '<div class="wrapper archive_property">';
      while($propreties->have_posts()){
        $propreties->the_post();
  
        $this->aleProperty_Template->get_template_part('partials/content');
  
      }
      echo '</div>';
    }
    wp_reset_postdata();
	}

}