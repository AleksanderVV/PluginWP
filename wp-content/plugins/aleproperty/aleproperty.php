<?php
/*
Plugin Name: aleProperty
Plugin URI: https://geniuscourses.com/
Description: First Plugin
Version: 1.0
Author: CRIK0VA
Author URI: https://geniuscourses.com/
Licence: GPLv2 or later
Text Domain: aleproperty
Domain Path: /lang
*/

if(!defined('ABSPATH')){
    die;
}

define('ALEPROPERTY_PATH',plugin_dir_path(__FILE__));

if(!class_exists('alePropertyCustomPostType')){
  require ALEPROPERTY_PATH . 'inc/class-aleproperty-cpt.php';
}
if(!class_exists('Gamajo_Template_Loader')){
  require ALEPROPERTY_PATH . 'inc/class-gamajo-template-loader.php';
}
require ALEPROPERTY_PATH . 'inc/class-aleproperty-template-loader.php';
require ALEPROPERTY_PATH . 'inc/class-aleproperty-shortcodes.php';

class aleProperty{

  public function get_terms_hierarchical($tax_name,$current_term) {
    $taxonomy_terms = get_terms($tax_name,['hide_empty' => false, 'parent' => 0]);

    $html = '';
    if(!empty($taxonomy_terms)){

      foreach($taxonomy_terms as $term){

        if($current_term == $term->term_id){
          $html .= '<option value="'.$term->term_id.'" selected>'.$term->name.'</option>';
        } else {
          $html .= '<option value="'.$term->term_id.'">'.$term->name.'</option>';
        }

        $child_terms = get_terms($tax_name,['hide_empty' => false, 'parent' => $term->term_id]);

        if(!empty($child_terms)){
          foreach($child_terms as $child){
            if($current_term == $child->term_id){
              $html .= '<option value="'.$child->term_id.'" selected> - '.$child->name.'</option>';
            } else {
              $html .= '<option value="'.$child->term_id.'"> - '.$child->name.'</option>';
            }
          }
        }
      }
    }
    return $html;
  }

  function register(){
    add_action('admin_enqueue_scripts',[$this,'enqueue_admin']);
    add_action('wp_enqueue_scripts',[$this,'enqueue_front']);
    add_action('plugins_loaded',[$this,'load_text_domain']);
  }

  function load_text_domain(){
    load_plugin_textdomain('aleproperty', false, dirname(plugin_basename(__FILE__)).'/lang');
  }

  public function enqueue_admin(){
    wp_enqueue_style('aleProperty_style_admin', plugins_url('/assets/css/admin/style.css',__FILE__));
    wp_enqueue_script('aleProperty_script_admin', plugins_url('/assets/js/admin/scripts.js',__FILE__),array('jquery'));
  }
  public function enqueue_front(){
    wp_enqueue_style('aleProperty_style', plugins_url('/assets/css/front/style.css',__FILE__));
    wp_enqueue_script('aleProperty_script', plugins_url('/assets/js/front/scripts.js',__FILE__),array('jquery'));
  }

  static function activation(){
    flush_rewrite_rules(); // Обновляет правила перезаписи ЧПУ: удаляет имеющиеся, генерирует и записывает новые.
  }
  static function deactivation(){
    flush_rewrite_rules();
  }

}


if(class_exists('aleProperty')){
    $aleProperty = new aleProperty();
    $aleProperty->register();
}

register_activation_hook(__FILE__, array($aleProperty,'activation') );
register_deactivation_hook(__FILE__, array($aleProperty,'deactivation') );
