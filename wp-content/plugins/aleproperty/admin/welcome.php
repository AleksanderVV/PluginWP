<h1><?php esc_html_e('Welcome to Plugin','aleproperty'); ?></h1>
<div class="content">
  <?php settings_errors(); ?>
  <form action="options.php" method="POST">
    <?php
      settings_fields('aleproperty_settings');
      do_settings_sections('aleproperty_settings');
      submit_button();
    ?>

  </form>
</div>
