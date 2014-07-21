<?php





class acf_field_instagramfeed extends acf_field {


	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options


	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/

	function __construct()
	{
		// vars
		$this->name = 'instagramfeed';
		$this->label = __('Instagram Feed');
		$this->category = __("Basic",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
      'username' 				=> '',
			'endpoint' 				=> '',
      'cache_expiration' => 60
		);


		// do not delete!
    	parent::__construct();


    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.0.0'
		);

	}


	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like below) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/

	function create_options( $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/

		// key is needed in the field names to correctly save the data
		$key = $field['name'];


		// Create Field Options HTML
		?>

  <tr class="field_option field_option_<?php echo $this->name; ?>">
    <td class="label">
      <label><?php _e("Instagram Username",'acf'); ?></label>
      <p class="description"><?php _e("instagram username",'acf'); ?></p>
    </td>
    <td>
      <?php
      do_action('acf/create_field', array(
        'type'    =>  'text',
        'name'    =>  'fields['.$key.'][username]',
        'value'   =>  $field['username']
      ));
      ?>
    </td>
  </tr>
  <tr class="field_option field_option_<?php echo $this->name; ?>">
    <td class="label">
      <label><?php _e("Endpoint",'acf'); ?></label>
      <p class="description"><?php _e("endpoint",'acf'); ?></p>
    </td>
    <td>
      <?php
      do_action('acf/create_field', array(
        'type'    =>  'text',
        'name'    =>  'fields['.$key.'][endpoint]',
        'value'   =>  $field['endpoint']
      ));
      ?>
    </td>
  </tr>
	<tr class="field_option field_option_<?php echo $this->name; ?>">
		<td class="label">
			<label><?php _e("Cache Expiration",'acf'); ?></label>
			<span class="sub-field-instructions">In minutes</span>
		</td>
		<td>
			<?php
			do_action('acf/create_field', array(
				'type'    =>  'text',
				'name'    =>  'fields['.$key.'][cache_expiration]',
				'value'   =>  $field['cache_expiration']
			));
			?>
		</td>
	</tr>





		<?php

	}


	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/


	function create_field( $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/

		// perhaps use $field['preview_size'] to alter the markup?
		$key = $field['name'];
		$class 	= $field['class'];

    $username      = ( isset($field['value']['username']) && $field['value']['username'] != '') ? $field['value']['username'] : '';
    $endpoint      = ( isset($field['value']['endpoint']) && $field['value']['endpoint'] != '') ? $field['value']['endpoint'] : '';
		$cache_expiration      = ( isset($field['value']['cache_expiration'])) ? $field['value']['cache_expiration'] : 60;

    //display_instagram_media('instagram_feed_'.$cache_key);

    ?>
    <table id="acfinstagram" class="widefat acf-input-table row_layout">
      <tbody>
        <tr>
          <td class="acf_input-wrap">

    <table class="widefat acf_input">
      <tbody>
    <tr class="field">
      <td class="label"><label>User Name</label></td>
      <td>
        <input type="text" value="<?php echo $username; ?>" id="<?php echo esc_attr($key); ?>" class="<?php echo esc_attr($class); ?>" name="<?php echo $key.'[username]'; ?>"/>
      </td>
    </tr>
    <tr class="field">
      <td class="label">
        <label>Endpoint</label>
        <span class="sub-field-instructions"><a href="http://instagram.com/developer/endpoints/" target="_blank">https://api.instagram.com/v1/</a></span>
      </td>
      <td>
        <input type="text" value="<?php echo esc_attr($endpoint); ?>" id="<?php echo esc_attr($key); ?>" class="<?php echo esc_attr($class); ?>" name="<?php echo esc_attr($key.'[endpoint]'); ?>"/>
      </td>
    </tr>

		<tr class="field">
			<td class="label">
				<label>Cache Expiration</label>
				<span class="sub-field-instructions">In minutes</span>
			</td>
			<td>
				<input type="text" value="<?php echo $cache_expiration; ?>" id="<?php echo $key.'[cache_expiration]'; ?>" name="<?php echo $key.'[cache_expiration]'; ?>">
			</td>
		</tr>

		<tr class="field">
			<td class="label"><label>Response</label></td>
			<td>
				<?php /* <textarea id="<?php echo $key; ?>" class="<?php echo $class; ?>" name="<?php echo $key.'[response]'; ?>"><?php echo $response; ?></textarea> */ ?>
				<pre style="max-width: 500px; overflow: scroll; height: 400px;"><?php

					echo "<pre>" . print_r($this->make_api_call($endpoint, $cache_expiration) , true) . "</pre>";

				?></pre>
			</td>
		</tr>

      </tbody>
    </table>




          </td>
        </tr>
      </tbody>
    </table>
		<?php
	}


	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used


		// register ACF scripts
		wp_register_script( 'acf-input-instagramfeed', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version'] );
		wp_register_style( 'acf-input-instagramfeed', $this->settings['dir'] . 'css/input.css', array('acf-input'), $this->settings['version'] );


		// scripts
		wp_enqueue_script(array(
			'acf-input-instagramfeed',
		));

		// styles
		wp_enqueue_style(array(
			'acf-input-instagramfeed',
		));


	}


	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your create_field() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_head()
	{
		// Note: This function can be removed if not used
	}


	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add CSS + JavaScript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used
	}


	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add CSS and JavaScript to assist your create_field_options() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_head()
	{
		// Note: This function can be removed if not used
	}


	/*
	*  load_value()
	*
		*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in the database
	*/

	function load_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}


	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/

	function update_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}


	/*
	*  format_value()
	*
	*  This filter is applied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/

	function format_value( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/

		// perhaps use $field['preview_size'] to alter the $value?


		// Note: This function can be removed if not used
		return $value;
	}


	/*
	*  format_value_for_api()
	*
	*  This filter is applied to the $value after it is loaded from the db and before it is passed back to the API functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/

	function format_value_for_api( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/

		// perhaps use $field['preview_size'] to alter the $value?


		// Note: This function can be removed if not used
		return $value;
	}


	/*
	*  load_field()
	*
	*  This filter is applied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/

	function load_field( $field )
	{
		// Note: This function can be removed if not used
		return $field;
	}


	/*
	*  update_field()
	*
	*  This filter is applied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

  function update_field( $field, $post_id )
  {
    // Note: This function can be removed if not used
    return $field;
  }

	/*
	*  make_api_call()
	*
	*  This function calls the API and returns the decoded response
	*
	*  @param	$endpoint - the api url to call
	*  @param	$count - how many records you want to return
	*  @param	$fields - the fields we want from the API
	*
	*  @return the decoded response
	*/

	public function make_api_call( $endpoint, $cache_expiration = 60 ){

		$transient_key = substr('instagram' . sha1( $endpoint ), 0, 32); // restrain key length otherwise expiration isn't set

		if ( false === ( $converted_response = get_transient( $transient_key ) ) ) {

// get_transient(), base64_decode(), then, unseralize()

			if( !get_option('acf_instagram') ) {
				return 'Missing Facebook options';
			}

			$api_keys       	= get_option('acf_instagram');
			$api_credentials  = 'access_token=' . $api_keys['access_token'];

			$api_url = 'https://api.instagram.com/v1/' . $endpoint;

			if( strpos($api_url, '?') === false ){
				$api_url .= '?' . $api_credentials;
			} else {
				$api_url .= '&' . $api_credentials;
			}

			$get_response = wp_remote_get( $api_url );

			if( is_wp_error($get_response) || !isset( $get_response['body'] ) ){
				return 'Error making API call';
			}

			$raw_response = wp_remote_retrieve_body($get_response);

			if( acf_field_instagramfeed::json_invalid($raw_response) !== false ){
				return acf_field_instagramfeed::json_invalid($raw_response);
			}

			$converted_response = base64_encode( serialize( $raw_response ) );

			set_transient( $transient_key, $converted_response, intval($cache_expiration) * MINUTE_IN_SECONDS );
		}

		return json_decode( unserialize( base64_decode( $converted_response ) ) );
	}

	/*
	*  json_invalid()
	*
	*  This function checks to see if json can be decoded
	*
	*  @param	$json - raw json response
	*
	*  @return false if the json *can* be decoded, otherwise an error message
	*/

	private function json_invalid( $raw_json ){

		$response = false;

		$decoded = json_decode($raw_json);

		if( $decoded === null ){
			switch (json_last_error()) {
				case JSON_ERROR_NONE:
					$response = 'No errors';
				break;
				case JSON_ERROR_DEPTH:
					$response = 'Maximum stack depth exceeded';
				break;
				case JSON_ERROR_STATE_MISMATCH:
					$response = 'Underflow or the modes mismatch';
				break;
				case JSON_ERROR_CTRL_CHAR:
					$response = 'Unexpected control character found';
				break;
				case JSON_ERROR_SYNTAX:
					$response = 'Syntax error, malformed JSON';
				break;
				case JSON_ERROR_UTF8:
					$response = 'Malformed UTF-8 characters, possibly incorrectly encoded';
				break;
				default:
					$response = 'Unknown error';
				break;
			}
		}

		return $response;
	}



}


// create field
new acf_field_instagramfeed();

?>
