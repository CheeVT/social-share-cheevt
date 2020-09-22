<h1>  Share CheeVT Settings</h1>

<div style="margin-top: 10px;">
  <form action="options.php" method="POST">
  <?php settings_fields( 'social_share_cheevt' ); ?>
  <?php foreach($this->socialNetworks as $network): ?>
    <label for="<?php echo $network; ?>"><?php echo ucfirst($network); ?></label>
    <input type="checkbox" 
      name="social_share_settings[social_networks][<?php echo $network; ?>]" 
      value="1" id="<?php echo $network; ?>" 
      <?php echo array_key_exists($network, $options['social_networks']) ? 'checked' : ''; ?> />
  <?php endforeach; ?>
  <p>
    <button class="button button-primary">Save</button>
  </p>
  </form>
</div>