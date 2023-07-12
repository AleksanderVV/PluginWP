<div class="wrapper filter_form">
  <?php $aleProperty = new aleProperty(); ?>

  <form action="<?php get_post_type_archive_link('property'); ?>" method="POST">

    <select name="aleproperty_location">
      <option value=""><?php esc_html_e('Select Location','aleproperty'); ?></option>
      <?php echo $aleProperty->get_terms_hierarchical('location', $_POST['aleproperty_location']);?>
    </select>

    <select name="aleproperty_property-type">
      <option value=""><?php esc_html_e('Select Type','aleproperty'); ?></option>
      <?php echo $aleProperty->get_terms_hierarchical('property-type', $_POST['aleproperty_property-type']);?>
    </select>

    <input type="text" placeholder="<?php esc_html_e('Max Price','aleproperty'); ?>" name="aleproperty_price" 
      value="<?php if(isset($_POST['aleproperty_price'])) { echo esc_attr($_POST['aleproperty_price']);} ?>">

    <select name="aleproperty_type" id="aleproperty_type">
      <option value=""><?php esc_html_e('Select Offer','aleproperty'); ?></option>
      <option value="sale" <?php if(isset($_POST['aleproperty_type']) AND $_POST['aleproperty_type'] == 'sale') {echo 'selected';} ?>><?php esc_html_e('For Sale','aleproperty'); ?></option>
      <option value="rent" <?php if(isset($_POST['aleproperty_type']) AND $_POST['aleproperty_type'] == 'rent') {echo 'selected';} ?>><?php esc_html_e('For Rent','aleproperty'); ?></option>
      <option value="sold" <?php if(isset($_POST['aleproperty_type']) AND $_POST['aleproperty_type'] == 'sold') {echo 'selected';} ?>><?php esc_html_e('Sold','aleproperty'); ?></option>
    </select>

    <select name="aleproperty_agent">
      <option value=""><?php esc_html_e('Select Agents','aleproperty'); ?></option>
      <?php 
            $agents = get_posts(array('post_type'=>'agent','numberposts' => -1));
            
            $selected = '';
            if(isset($_POST['aleproperty_agent'])) {
              $agent_id = $_POST['aleproperty_agent'];
            }

            foreach ($agents as $agent) {
              echo '<option value="'.$agent->ID.'" '.selected($agent->ID, $agent_id, false).'>'.$agent->post_title.'</option>';
            }
      ?>
    </select>
    <input type="submit" value="<?php esc_html_e('Filter'); ?>" name="submit">
  </form>
</div>