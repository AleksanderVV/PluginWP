<?php
class aleProperty_Template_Loader extends Gamajo_Template_Loader {
  
  protected $filter_prefix = 'aleproperty';

  protected $theme_template_directory = 'aleproperty';

  protected $plugin_directory = ALEPROPERTY_PATH;

  protected $plugin_template_directory = 'templates';

  public function register() {
    add_filter('template_include',[$this,'aleproperties_templates']);
  }

  public function aleproperties_templates($template) {

    if(is_post_type_archive('property')){
      $theme_files = ['archive-property.php','aleproperty/archive-property.php'];
      $exist = locate_template($theme_files,false);
      
      if($exist != ''){
        return $exist;
      } else {
        return plugin_dir_path(__DIR__).'templates/archive-property.php';
      }
    } elseif(is_post_type_archive('agent')){
      $theme_files = ['archive-agent.php','aleproperty/archive-agent.php'];
      $exist = locate_template($theme_files,false);
      
      if($exist != ''){
        return $exist;
      } else {
        return plugin_dir_path(__DIR__).'templates/archive-agent.php';
      }
    } elseif(is_singular('property')){
      $theme_files = ['single-property.php','aleproperty/single-property.php'];
      $exist = locate_template($theme_files,false);
      
      if($exist != ''){
        return $exist;
      } else {
        return plugin_dir_path(__DIR__).'templates/single-property.php';
      }
    } elseif(is_singular('agent')){
      $theme_files = ['single-agent.php','aleproperty/single-agent.php'];
      $exist = locate_template($theme_files,false);
      
      if($exist != ''){
        return $exist;
      } else {
        return plugin_dir_path(__DIR__).'templates/single-agent.php';
      }
    }
    return $template;

    
  }
  
}

$aleProperty_Template = new aleProperty_Template_Loader();
$aleProperty_Template->register();