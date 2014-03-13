<?php
/*
Plugin Name: Current Planetary Positions
Plugin URI: http://isabelcastillo.com/downloads/current-planetary-positions-wp-plugin/
Description: Display the current planetary positions in the zodiac signs.
Version: 1.2.3
Author: Isabel Castillo
Author URI: http://isabelcastillo.com
License: GPL2
Text Domain: cpp
Domain Path: languages

Copyright 2013 Isabel Castillo

This file is part of Current Planetary Positions Plugin.

Current Planetary Positions Plugin is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

Current Planetary Positions Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Current Planetary Positions Plugin; if not, If not, see <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>.
*/
if(!class_exists('Current_Planetary_Positions')) {
class Current_Planetary_Positions{
    public function __construct() {

		add_action( 'admin_init', array($this, 'updater'), 5 );
		add_action( 'admin_init', array($this, 'register_options') );
		add_action( 'admin_init', array($this, 'activate_license') );
		add_action( 'admin_init', array($this, 'deactivate_license') );
		add_action( 'admin_init', array($this, 'check_status') );
		add_action( 'admin_menu', array($this, 'add_plugin_page') );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );


		// @new update. CONSTANT SHOULD BE UNIQUE
		if( ! defined( 'CPP_ISABEL_STORE_URL' ) )
			define( 'CPP_ISABEL_STORE_URL', 'http://isabelcastillo.com' );
		if( ! defined( 'CURRENT_PLANETARY_POS_DLNAME' ) )
			define( 'CURRENT_PLANETARY_POS_DLNAME', 'Current Planetary Positions WP Plugin' );// @new name match exactly

		if( ! defined( 'CPP_PLUGIN_DIR' ) )
			define( 'CPP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		if( !class_exists( 'EDD_SL_Plugin_Updater' ) )
			include CPP_PLUGIN_DIR . 'EDD_SL_Plugin_Updater.php';

		require_once CPP_PLUGIN_DIR . 'cpp-widget.php';

    }

   	public function enqueue() {
		
		wp_register_style('cpp', plugins_url('/style.css', __FILE__));
		wp_enqueue_style('cpp');
	}

	public function plugins_loaded() {
		load_plugin_textdomain( 'cpp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		$wantedPerms = 0755;
		$actualPerms = substr(sprintf('%o', fileperms(CPP_PLUGIN_DIR . '/sweph/isabelse')), -4);
		if($actualPerms !== $wantedPerms)
		chmod(CPP_PLUGIN_DIR . '/sweph/isabelse', $wantedPerms);
	}

	/**
	* Set up easy updates.
	* @since 1.2.3
	*/

	public function updater() {
		
		$license_key = trim( get_option( 'isa_cpp_license_key' ) );// @new
		
		$edd_updater = new EDD_SL_Plugin_Updater( CPP_ISABEL_STORE_URL, __FILE__, array( 
				'version' 	=> '1.2.3',  // @todo update current version number
				'license' 	=> $license_key,
				'item_name' => CURRENT_PLANETARY_POS_DLNAME,
				'author' 	=> 'Isabel Castillo'
			)
		);
	
	}
		
	/**
	* Set up easy updates.
	* @since 1.2.3
	*/

	public function register_options(){	

		register_setting( 'isa_cpp_license', 'isa_cpp_license_key', array($this, 'isa_sanitize_license') );

	}

	/**
	* Output the license page.
	* @since 1.2.3
	*/

	public function cpp_license_page() {
		$license 	= get_option( 'isa_cpp_license_key' );
		$status 	= get_option( 'isa_cpp_license_status' );
		?>
		<div class="wrap">
			<h2><?php _e( 'Current Planetary Positions License Options', 'cpp' ); ?></h2>
		
		<p><?php _e( 'A plugin license will grant you access to support and updates. If you wish to update to the latest version of Current Planetary Positions or get support for this plugin, you need an active license.', 'cpp' ); ?>
		&nbsp; <a href="<?php echo CPP_ISABEL_STORE_URL; ?>/downloads/" target="_blank"><?php _e( 'Purchase a license', 'cpp' ); ?></a></p>
		
			<form method="post" action="options.php">
				
				<?php settings_fields('isa_cpp_license'); ?>
				
				<table class="form-table">
						<tbody>
							<tr valign="top">	
								<th scope="row" valign="top">
									<?php _e('License Key', 'cpp'); ?>
								</th>
								<td>
									<input id="isa_cpp_license_key" name="isa_cpp_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
									<label class="description" for="isa_cpp_license_key"><?php _e('Enter your license key', 'cpp'); ?></label>
								</td>
							</tr>
							<?php if( false !== $license ) { ?>
								<tr valign="top">	
									<th scope="row" valign="top">
										<?php _e('Activate License', 'cpp' ); ?>
									</th>
									<td>
										<?php if( $status !== false && 'valid' == $status ) { ?>
		
				<span style="color:green;font-weight:bold;padding:12px;"><?php _e('Status: active  ', 'cpp' ); ?></span>
		
											<?php wp_nonce_field( 'isa_cpp_nonce', 'isa_cpp_nonce' ); ?>
											<input type="submit" class="button-secondary" name="isa_cpp_license_deactivate" value="<?php _e('Deactivate License', 'cpp' ); ?>"/><br/ ><br/ ><br/ >
		
		<input type="submit" class="button-secondary" name="isa_cpp_license_check" value="<?php _e('Check Status', 'cpp' ); ?>"/>
		
										<?php } else {
		if( empty( $status ) ) $status == 'not active'; ?>
				<span style="color:red;font-weight:bold;padding:12px;"><?php printf( __('Status: %s', 'cpp'), $status ); ?></span>
		
		<?php
										wp_nonce_field( 'isa_cpp_nonce', 'isa_cpp_nonce' ); ?>
											<input type="submit" class="button-secondary" name="isa_cpp_license_activate" value="<?php _e('Activate License', 'cpp' ); ?>"/>
										<?php } ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>	
					<?php submit_button(); ?>
				
				</form>
			<?php
	}
		
	public function add_plugin_page(){
			add_plugins_page( __( 'Current Planetary Positions License', 'cpp' ), __( 'Current Planetary Positions License', 'cpp' ), 'manage_options', 'current-planetary-positions-license', array($this, 'cpp_license_page') );// @new

    }

	/**
	* Gets rid of the local license status option when adding a new one
	* @since 1.2.3
	*/

	public function isa_sanitize_license( $new ) {
		$old = get_option( 'isa_cpp_license_key' );
		if( $old && $old != $new ) {
			delete_option( 'isa_cpp_license_status' ); // new license has been entered, so must reactivate
		}
		return $new;
	}
		


	/**
	* Activate license key.
	* @since 1.2.3
	*/
	public function activate_license() {
		
		if( isset( $_POST['isa_cpp_license_activate'] ) ) {
		
			// run a quick security check 
		 	if( ! check_admin_referer( 'isa_cpp_nonce', 'isa_cpp_nonce' ) ) 	
				return; // get out if we didn't click the Activate button
				$license = trim( get_option( 'isa_cpp_license_key' ) );
	
			$api_params = array( 
				'edd_action'=> 'activate_license', 
				'license' 	=> $license, 
				'item_name' => urlencode( CURRENT_PLANETARY_POS_DLNAME )
			);
				
			$response = wp_remote_get( add_query_arg( $api_params, CPP_ISABEL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
		
			if ( is_wp_error( $response ) )
				return false;
		
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
				
			// $license_data->license will be either "active" or "inactive"
			update_option( 'isa_cpp_license_status', $license_data->license );
		}
	}

	/**
	* Deactivate a license key, allows user to transfer license to another site. 
	* @since 1.2.3
	*/
		
	public function deactivate_license() {
		
		if( isset( $_POST['isa_cpp_license_deactivate'] ) ) {
		
		 	if( ! check_admin_referer( 'isa_cpp_nonce', 'isa_cpp_nonce' ) ) 	
				return; // get out if we didn't click the Activate button
		
			$license = trim( get_option( 'isa_cpp_license_key' ) );
			$api_params = array( 
				'edd_action'=> 'deactivate_license', 
				'license' 	=> $license, 
				'item_name' => urlencode( CURRENT_PLANETARY_POS_DLNAME )
			);
				
			$response = wp_remote_get( add_query_arg( $api_params, CPP_ISABEL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
		
			if ( is_wp_error( $response ) )
				return false;
		
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			// $license_data->license will be either "deactivated" or "failed"
			if( $license_data->license == 'deactivated' )
				delete_option( 'isa_cpp_license_status' );
		
		}
	}

	/**
	* Checks license status in options page when secondary button is clicked.
	* @return string expired/active/inactive
	* @since 1.2.3
	*/
		
	public function check_status() {
		
		if( isset( $_POST['isa_cpp_license_check'] ) ) {
		
			global $wp_version;
		
			$license = trim( get_option( 'isa_cpp_license_key' ) );
			
			$api_params = array(
				'edd_action' => 'check_license',
				'license' => $license,
				'item_name' => urlencode( CURRENT_PLANETARY_POS_DLNAME )
			);
			
			$response = wp_remote_get( add_query_arg( $api_params, CPP_ISABEL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
			
			if ( is_wp_error( $response ) )
				return false;
			
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
			if( 'expired' == $license_data->license )
				$status = 'expired';
			elseif( 'valid' == $license_data->license )
				$status = 'active';
			else
				$status = 'inactive';
		
			update_option( 'isa_cpp_license_status', $status );

		}
	}

		
	/** 
	 * Registers the widget.
	 * @since 1.0
	 */
	function register_widgets() {
		register_widget( 'cpp_widget' );
	}

}
}
$Current_Planetary_Positions = new Current_Planetary_Positions();