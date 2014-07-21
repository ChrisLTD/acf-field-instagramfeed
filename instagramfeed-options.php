<?php
// Register Style
function acf_instagram_styles() {
  wp_register_style( 'acf-instagramfeed-style', plugin_dir_url( __FILE__ ) . 'css/input.css', false, '1' );
  wp_enqueue_style( 'acf-instagramfeed-style' );
}
add_action('admin_enqueue_scripts', 'acf_instagram_styles');
// Hook into the 'admin_enqueue_scripts' action

function instagramfeed_register_settings() {
  // add_option( 'acf_instagram_client_id', '');
  // add_option( 'acf_instagram_client_secret', '');
  // add_option( 'acf_instagram_access_token', '');
  register_setting( 'acf_instagram_options', 'acf_instagram' );
  // register_setting( 'default', 'acf_instagram_client_secret' );
  // register_setting( 'default', 'acf_instagram_access_token' );
}
add_action( 'admin_init', 'instagramfeed_register_settings' );


function instagramfeed_register_options_page() {
  add_options_page('ACF Instagram Feed', 'ACF Instagram', 'manage_options', 'instagramfeed-options', 'instagramfeed_options_page');
}
add_action('admin_menu', 'instagramfeed_register_options_page');




function instagramfeed_options_page() {
?>

<style type="text/css">
  .instagram_class {
    min-width: 350px
  }
</style>
<div class="wrap">
  <h2>Your ACF Instagram Options</h2>
  <form method="post" action="options.php">
    <?php settings_fields('acf_instagram_options'); ?>
    <?php $options = get_option('acf_instagram'); ?>
    <h3>Your App's API info from Instagram</h3>
    <table class="form-table acf_postbox field_type-instagramfeed ">
      <tr valign="top" class="field">
        <th scope="row"><label for="acf_instagram_client_id">client ID</label></th>
        <td>
          <div class="input-group">
            <span class="input-group-addon">acf_instagram &rsaquo; client_id</span>
            <input type="text" class="instagram_class" id="acf_instagram_client_id" name="acf_instagram[client_id]" value="<?php echo $options['client_id']; ?>" />
          </div>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="acf_instagram_client_secret">client Secret</label></th>
        <td>
          <div class="input-group">
            <span class="input-group-addon">acf_instagram &rsaquo; client_secret</span>
            <input type="text" class="instagram_class" id="acf_instagram_client_secret" name="acf_instagram[client_secret]" value="<?php echo $options['client_secret']; ?>" />
          </div>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="acf_instagram_access_token">Access Token</label></th>
        <td>
          <div class="input-group">
            <span class="input-group-addon">acf_instagram  &rsaquo; access_token</span>
            <input type="text" class="instagram_class" id="acf_instagram_access_token" name="acf_instagram[access_token]" value="<?php echo $options['access_token']; ?>" />
          </div>
        </td>
      </tr>
    </table>
    <?php submit_button(); ?>
  </form>
</div>
<?php
}
?>
