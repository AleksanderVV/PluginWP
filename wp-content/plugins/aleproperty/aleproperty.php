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
  require ALEPROPERTY_PATH . 'inc/cpt.php';
}

class aleProperty{

  static function activation(){
    flush_rewrite_rules(); // Обновляет правила перезаписи ЧПУ: удаляет имеющиеся, генерирует и записывает новые.
  }
  static function deactivation(){
    flush_rewrite_rules();
  }
}


if(class_exists('aleProperty')){
    $aleProperty = new aleProperty();
}

register_activation_hook(__FILE__, array($aleProperty,'activation') );
register_deactivation_hook(__FILE__, array($aleProperty,'deactivation') );
