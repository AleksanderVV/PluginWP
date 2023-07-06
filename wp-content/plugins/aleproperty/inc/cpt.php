<?php
if(!class_exists('alePropertyCustomPostType')) {

  class alePropertyCustomPostType{
    public function register(){
      add_action('init',array($this,'custom_post_type'));
      add_action('add_meta_boxes',[$this,'add_meta_box_property']);
      add_action('save_post',[$this,'save_metabox'],10,2);
    }

    public function add_meta_box_property(){
      add_meta_box('aleproperty_seetings',
                    'Property Settings',
                    [$this, 'metabox_property_html'],
                    'property',
                    'normal',
                    'default'
      );
    }

    public function save_metabox($post_id,$post){
      // проверки для скрытых полей - создаем ниже
       if(!isset($_POST['_aleproperty']) || !wp_verify_nonce($_POST['_aleproperty'], 'alepropertyfields')){ //проверка на нонсы
        return $post_id;
      }
       if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { // проверка на автосохранение - отключаем автосохранение
        return $post_id;
      }
      if($post->post_type != 'property') { // проверка на посттайп Property
        return $post_id;
      }
      $post_type = get_post_type_object($post->post_type); //проверка разрешено ли пользователю сохранять посты
      if(!current_user_can($post_type->cap->edit_post,$post_id)){
        return $post_id;
      }

      if(is_null($_POST['aleproperty_price'])){
        delete_post_meta($post_id, 'aleproperty_price');
      } else {
        update_post_meta($post_id,'aleproperty_price',sanitize_text_field(intval($_POST['aleproperty_price'])));
      }

      if(is_null($_POST['aleproperty_period'])){
        delete_post_meta($post_id, 'aleproperty_period');
      } else {
        update_post_meta($post_id,'aleproperty_period',sanitize_text_field($_POST['aleproperty_period']));
      }

      if(is_null($_POST['aleproperty_type'])){
        delete_post_meta($post_id, 'aleproperty_type');
      } else {
        update_post_meta($post_id,'aleproperty_type',sanitize_text_field($_POST['aleproperty_type']));
      }

      if(is_null($_POST['aleproperty_agent'])){
        delete_post_meta($post_id, 'aleproperty_agent');
      } else {
        update_post_meta($post_id,'aleproperty_agent',sanitize_text_field($_POST['aleproperty_agent']));
      }
    }

    public function metabox_property_html($post){

      $price = get_post_meta($post->ID, 'aleproperty_price', true);
      $period = get_post_meta($post->ID, 'aleproperty_period', true);
      $type = get_post_meta($post->ID, 'aleproperty_type', true);
      $agent_meta = get_post_meta($post->ID,'aleproperty_agent',true);

      wp_nonce_field('alepropertyfields', '_aleproperty'); //скрытые инпуты
      
      echo '
      <p>
        <label for="aleproperty_price">'.esc_html__('Price','aleproperty').'</label>
        <input type="number" id="aleproperty_price" name="aleproperty_price" value="'.esc_attr($price).'">
      </p>
      <p>
        <label for="aleproperty_period">'.esc_html__('Period','aleproperty').'</label>
        <input type="text" id="aleproperty_period" name="aleproperty_period" value="'.esc_attr($period).'">
      </p>
      <p>
        <label for="aleproperty_type">'.esc_html__('Type','aleproperty').'</label>
        <select id="aleproperty_type" name="aleproperty_type">
          <option value="empty">'.esc_html__('Select Type','aleproperty').'</option>
          <option value="sale" '.selected('sale',$type,false).'>'.esc_html__('For Sale','aleproperty').'</option>
          <option value="rent" '.selected('rent',$type,false).'>'.esc_html__('For Rent','aleproperty').'</option>
          <option value="sold" '.selected('sold',$type,false).'>'.esc_html__('Sold','aleproperty').'</option>
        </select>
      </p>
      ';

      $agents = get_posts(array(
        'post_type' => 'agent',
        'posts_per_page' => -1
      ));
      
      if($agents) {
        echo '
          <p>
            <label for="aleproperty_agent">'.esc_html__('Agents','aleproperty').'</label>
            <select type="text" id="aleproperty_agent" name="aleproperty_agent">
              <option value="empty">'.esc_html__('Select Agent','aleproperty').'</option>';
            
            foreach($agents as $agent) { ?>
              <option value="<?php echo esc_html($agent->ID); ?>" <?php if($agent->ID == $agent_meta){echo 'selected'; } ?>><?php echo esc_html($agent->post_title); ?></option>
            <?php }
            echo '
            </select>
          </p>
          ';
      }

    }

    public function custom_post_type(){
      register_post_type('property', 
        array(
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'Properties'),
          'label' => esc_html__('Property','aleproperty'),
          'supports' => array('title','editor','thumbnail')
      ));
      register_post_type('agent', 
      array(
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'Agents'),
        'label' => esc_html__('Agents','aleproperty'),
        'supports' => array('title','editor','thumbnail'),
        'show_in_rest' => true // connect Guttenberg
      ));

      $args = array(
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug'=>'properties/location'),
        'labels' => array(
          'name'              => esc_html_x('Locations', 'taxonomy general name','aleproperty'),
          'singular_name'     => esc_html_x('Location', 'taxonomy singular name','aleproperty'),
          'search_items'      => esc_html__('Search Locations','aleproperty'),
          'all_items'         => esc_html__('All Locations','aleproperty'),
          'view_item '        => esc_html__('View Location','aleproperty'),
          'parent_item'       => esc_html__('Parent Location','aleproperty'),
          'parent_item_colon' => esc_html__('Parent Location:','aleproperty'),
          'edit_item'         => esc_html__('Edit Location','aleproperty'),
          'update_item'       => esc_html__('Update Location','aleproperty'),
          'add_new_item'      => esc_html__('Add New Location','aleproperty'),
          'new_item_name'     => esc_html__('New Location Name','aleproperty'),
          'menu_name'         => esc_html__('Location','aleproperty'),
          'back_to_items'     => esc_html__('← Back to Location','aleproperty'),
        )
      );
      register_taxonomy('location','property', $args);

      unset($args); //Clear variable args

      $args = array(
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug'=>'properties/type'),
        'labels' => array(
          'name'              => esc_html_x('Types', 'taxonomy general name','aleproperty'),
          'singular_name'     => esc_html_x('Type', 'taxonomy singular name','aleproperty'),
          'search_items'      => esc_html__('Search Types','aleproperty'),
          'all_items'         => esc_html__('All Types','aleproperty'),
          'view_item '        => esc_html__('View Type','aleproperty'),
          'parent_item'       => esc_html__('Parent Type','aleproperty'),
          'parent_item_colon' => esc_html__('Parent Type:','aleproperty'),
          'edit_item'         => esc_html__('Edit Type','aleproperty'),
          'update_item'       => esc_html__('Update Type','aleproperty'),
          'add_new_item'      => esc_html__('Add New Type','aleproperty'),
          'new_item_name'     => esc_html__('New Type Name','aleproperty'),
          'menu_name'         => esc_html__('Type','aleproperty'),
          'back_to_items'     => esc_html__('← Back to Type','aleproperty'),
        )
      );
      register_taxonomy('property-type','property', $args);
    }
  }
}

if(class_exists('alePropertyCustomPostType')){
  $alePropertyCustomPostType = new alePropertyCustomPostType();
  $alePropertyCustomPostType->register();
}