<?php
/*
Plugin Name: Popupbooster plugin
Plugin URI: http://www.popupbooster.com
Description: This plugin makes it simple to add Popupbooster to your blog. <a href="options-general.php?page=popupbooster.php">Configuration Page</a>
Author: Piet Hadermann
Version: 0.9
Author URI: http://www.popupbooster.com
License: GPL

Based on Joost de Valk's Google Analytics for Wordpress plugin and Jules Stuifbergen Piwik Analytics plugin

*/

// Pre-2.6 compatibility
if ( !defined('WP_CONTENT_URL') )
    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if ( !defined('WP_CONTENT_DIR') )
    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );

/*
 * Admin User Interface
 */

if ( ! class_exists( 'PUB_Admin' ) ) {

	class PUB_Admin {

		function add_config_page() {
			global $wpdb;
			if ( function_exists('add_options_page') ) {
				add_options_page('Popupbooster Configuration', 'Popupbooster', 9, basename(__FILE__), array('PUB_Admin','config_page'));
			}
		} // end add_PUB_config_page()

		function config_page() {
			if ( $_GET['reset'] == "true") {
				$options['jscript'] = '';
				update_option('Popupbooster',$options);
			}
				
			if ( isset($_POST['submit']) ) {
				if (!current_user_can('manage_options')) die(__('You cannot edit the Popupbooster options.'));
				check_admin_referer('pub-config');

				if (isset($_POST['jscript']) && $_POST['jscript'] != "") 
					$options['jscript'] = strtolower($_POST['jscript']);

				 if (isset($_POST['enabled'])) {
                                        $options['enabled'] = true;
                                } else {
                                        $options['enabled'] = false;
                                }

				update_option('Popupbooster', $options);
			}

			$options  = get_option('Popupbooster');
			?>
			<div class="wrap">
				<h2>Popupbooster Configuration</h2>
				<p>
					Don't have a Popupbooster account yet? Sign up for an account <a href="http://app.popupbooster.com/signup">here</a>.
				</p>
				<form action="" method="post" id="pub-conf">
					<table class="form-table" style="width:100%;">
					<?php
					if ( function_exists('wp_nonce_field') )
						wp_nonce_field('pub-config');
					?>
					<tr>
						<th scope="row" style="width:100px;" valign="top">
							<label for="jscript">Javascript code</label> 
						</th>
						<td>
							<input id="jscript" name="jscript" type="text" size="100" maxlength="100" value="<?php echo htmlentities(stripslashes($options['jscript'])); ?>" style="font-family: 'Courier New', Courier, mono;" /><br/>
							<small>
							Enter the javascript code here. You can find the javascript in the gray box in the 'config' tab.
							</small>
						</td>
					</tr>						
					<tr>
						<th scope="row" valign="top">
							<label for="enabled">Enabled</label>
						</th>
						<td>
							<input type="checkbox" id="enabled" name="enabled" <?php if ($options['enabled']) echo ' checked="unchecked" ';?>/><br/>
							<small>
							Please uncheck if you'd like to temporary disable Popupbooster
							</small>
						</td>
					</tr>
					</table>
					<p style="border:0;" class="submit"><input type="submit" name="submit" value="Update Settings &raquo;" /></p>
				</form>
			</div>
			<?php
			if (isset($options['jscript'])) {
				if ($options['jscript'] == "" || $options['enabled']==false) {
					add_action('admin_footer', array('PUB_Admin','warning'));
				} else {

					if ($options['jscript'] != "" && $options['enabled']==true) {
						add_action('admin_footer', array('PUB_Admin','success'));
					}
/*
					if (isset($_POST['submit'])) {
						if ($_POST['jscript'] != $options['jscript'] ) {
							add_action('admin_footer', array('PUB_Admin','success'));
						}
					}
*/
				}
			} else {
				add_action('admin_footer', array('PUB_Admin','warning'));
			}

		} // end config_page()

		function restore_defaults() {
			$options['jscript'] = '';
			update_option('Popupbooster',$options);
		}
		
		function success() {
			echo "
			<div id='analytics-warning' class='updated fade-ff0000'><p><strong>Congratulations! Popupbooster is active!</p></div>";
		} // end success()

		function warning() {
			echo "
			<div id='analytics-warning' class='updated fade-ff0000'><p><strong>Popupbooster is not active.</strong> You must enter your javascript code and check the enabled flag for it to work.</p></div>";
		} // end warning()

	} // end class PUB_Admin

} //endif


/**
 * Code that actually inserts stuff into pages.
 */
if ( ! class_exists( 'PUB_Filter' ) ) {
	class PUB_Filter {
		/*
		 * Insert the tracking code into the page
		 */
		function spool_analytics() {
			$options  = get_option('Popupbooster');
			if ($options['jscript'] != '' && $options['enabled']) {
				echo "\n<!-- Popupbooster.com plugin begin -->\n";
				echo stripslashes($options['jscript']);
				echo "\n<!-- Popupbooster.com plugin end -->\n";
			}
		}
	} // class PUB_Filter
} // endif


$gaf = new PUB_Filter();

$options  = get_option('Popupbooster',"");

if ($options == "") {
	$options['jscript'] = '';
	$options['enabled'] = false;
	update_option('Popupbooster',$options);
}

// adds the menu item to the admin interface
add_action('admin_menu', array('PUB_Admin','add_config_page'));


// adds the footer so the javascript is loaded
add_action('wp_footer', array('PUB_Filter','spool_analytics'));	

?>
