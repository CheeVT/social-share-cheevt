<div class="wrap">
  <h1>Social Share CheeVT</h1>

  <div style="margin-top: 10px;">
    <?php settings_errors(); ?>
    <form action="options.php" method="POST">
      <?php settings_fields( 'social_share_cheevt' ); ?>
      <?php do_settings_sections( 'social_share_cheevt' ); ?>
      <?php submit_button(); ?>
    </form>
  </div>
</div>