<?php

class Elementor_Properties_Widget extends \Elementor\Widget_Base {

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
		return [ 'general' ];
	}

	protected function register_controls() {

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

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
    echo 'List of properties';
		// $html = wp_oembed_get( $settings['url'] );

		// echo '<div class="oembed-elementor-widget">';
		// echo ( $html ) ? $html : $settings['url'];
		// echo '</div>';

	}

}