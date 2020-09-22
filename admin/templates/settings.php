<h1>  Share CheeVT Settings</h1>

<div style="margin-top: 10px;">
  <form action="options.php" method="POST">
  <?php settings_fields( 'social_share_cheevt' ); ?>
  <h3>Social Networks</h3>
  <?php foreach($this->socialNetworks as $network): ?>
    <label for="<?php echo $network; ?>"><img src="<?php echo SOCIAL_SHARE_CHEEVT_PLUGIN_URL . '/assets/images/' . $network; ?>" style="width: 30px;"/></label>
    <input type="checkbox" 
      name="social_share_settings[social_networks][<?php echo $network; ?>]" 
      value="1" id="<?php echo $network; ?>" 
      <?php echo array_key_exists($network, $options['social_networks']) ? 'checked' : ''; ?> />
      <!-- <svg height="32" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><defs id="defs12"/><g id="g5991"><rect height="512" id="rect2987" rx="64" ry="64" style="fill:#3b5998;fill-opacity:1;fill-rule:nonzero;stroke:none" width="512" x="0" y="0"/><path d="M 286.96783,455.99972 V 273.53753 h 61.244 l 9.1699,-71.10266 h -70.41246 v -45.39493 c 0,-20.58828 5.72066,-34.61942 35.23496,-34.61942 l 37.6554,-0.0112 V 58.807915 c -6.5097,-0.87381 -28.8571,-2.80794 -54.8675,-2.80794 -54.28803,0 -91.44995,33.14585 -91.44995,93.998125 v 52.43708 h -61.40181 v 71.10266 h 61.40039 v 182.46219 h 73.42707 z" id="f_1_" style="fill:#ffffff"/></g></svg> -->
  <?php endforeach; ?>
  <p>
    <h3>Post Types</h3>
    <?php foreach($postTypes as $type): ?>
      <label for="<?php echo $type; ?>"><?php echo ucfirst($type); ?></label>
      <input type="checkbox" 
        name="social_share_settings[post_types][<?php echo $type; ?>]" 
        value="1" id="<?php echo $type; ?>" 
        <?php echo array_key_exists($type, $options['post_types']) ? 'checked' : ''; ?> />
    <?php endforeach; ?>
  </p>
  <p>
    <button class="button button-primary">Save</button>
  </p>
  </form>
</div>