<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://madtek.com
 * @since      1.0.0
 *
 * @package    madtek_entrusans
 * @subpackage madtek_entrusans/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Madtek_Entrusans
 * @subpackage Plugin_Name/admin
 * @author     jeemadtekcom
 */
class Madtek_Entrusans_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
                add_action( 'admin_menu', array( $this, 'admin_menu') );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/madtek-entrusans-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/madtek-entrusans-admin.js', array( 'jquery' ), $this->version, false );

	} // 
	
        /**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function admin_menu() {

		/**
		 * This function is used to put up the admin page for Entrusans activation.
		 */
/**/
                add_menu_page( __( 'Entrusans IDS', 'madtek_entrusans' ), 
                               __( 'Entrusans IDS', 'madtek_entrusans' ), 
                              'manage_options', 
                              'madtek_entrusans', 
                               array($this, 'entrusans_admin_page'), 
                               null, null ); // Note there are 2 trailing params that are currently left out
/**/

	} // end admin_menu
	
        /**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function entrusans_admin_page() {


	/**
	 * This function is used to put up the Entrusans admin page for activation.
	 */

      global $wpdb;
      $status = get_option( 'madtek_entrusans_status' );

      switch ($status) {

        case "connected":

          ?>
          <h3>Entrusans&trade; Intrusion Detection Service</h3>
          <?php
          $lkey = get_option( 'madtek_entrusans_license' );
          ?>
          <h4>Status: Active</h4>
          <div class="entrusans-info">
            <h4>License Key: <?php echo $lkey ?></h4></p>
          </div>
          <?php 
          break;

        case "activated":
          if (isset($_POST['licensekey']) && isset($_POST['emailaddr'])) {
          ?>
            <h3>Entrusans&trade; IDS Post Detected Activation Underway</h3>
          <?php

            global $wpdb;

            $url_to_poll = get_site_url();

            $domain = get_option( 'madtek_entrusans_domain' );
            if (!$domain) {
              echo 'Error 201 - retrieving domain<p>Activation failed see <a href="https://madtek.com/content/troubleshooting-entrusans%E2%84%A2-ids-activation">the Entrusans IDS troubleshooting</a> page for information on activation failures.<p>';
              return;
            }

            $lkey = $_POST['licensekey'];
            if (!preg_match('/^[a-z0-9]+\-[a-z0-9]+\-[a-z0-9]+\-[a-z0-9]+\-[a-z0-9]+$/', $lkey)) {
              echo 'Error 202 - invalid license key - ' . $lkey . '<p>Activation failed see <a href="https://madtek.com/content/troubleshooting-entrusans%E2%84%A2-ids-activation">the Entrusans IDS troubleshooting</a> page for information on activation failures.<p>';
              return;

            }


            $email = sanitize_email($_POST['emailaddr']);
            if (!$email) {
              echo 'Error 203 - invalid email address<p>Activation failed see <a href="https://madtek.com/content/troubleshooting-entrusans%E2%84%A2-ids-activation">the Entrusans IDS troubleshooting</a> page for information on activation failures.<p>';
              return;
            }  

            $email = filter_var($_POST['emailaddr'], FILTER_SANITIZE_EMAIL);
            if (!$email) {
              echo 'Error 203b - invalid email address<p>Activation failed see <a href="https://madtek.com/content/troubleshooting-entrusans%E2%84%A2-ids-activation">the Entrusans IDS troubleshooting</a> page for information on activation failures.<p>';
              return;
            }  

            $url = "https://$domain?wc-api=software-api&request=activation&email=" . $email . "&license_key=" . $lkey . "&product_id=ENTRUSANS-WP&url_to_poll=" . $url_to_poll . "&host=" .  $_SERVER['HTTP_HOST']; 

            $response = wp_remote_get( $url );
            $response_code = wp_remote_retrieve_response_code( $response );

            if ($response_code != 200) {
              echo 'Error 104 - contacting activation server code = ' . $response['response']['code'] . ' <p>Activation failed see <a href="https://madtek.com/content/troubleshooting-entrusans%E2%84%A2-ids-activation">the Entrusans IDS troubleshooting</a> page to troubleshoot activation failures.<p>';
              return;
            }

            $body = $response['body'];
            $body = str_replace("NULL","",$body);
/**/
            $parts = explode('}', $body);
            foreach ($parts as $x) {
              if (preg_match ('/\"code\"/i', $x)) {
                $smresp = $x . '}';
              }
              if (preg_match ('/\"rmsg\"/i', $x)) {
                $keylist = $x . '}';
              }
            }


            if (isset($smresp)) {
              $sm = json_decode($smresp, true);
            }

            if (isset($sm['error'])) {
                echo $sm['error'] . ' : code - ' . $sm['code'];
                echo '<p>' . $keys['rmsg'];
            } else {  

              $keys = json_decode($keylist, true);
              if ($keys['rc']) {

                $rc = update_option( 'madtek_entrusans_cpbk', $keys['cpbk'] );
                if (!$rc) {
                   echo 'Error 205 - insert error<p>Activation failed see <a href="https://madtek.com/content/troubleshooting-entrusans%E2%84%A2-ids-activation">the Entrusans IDS troubleshooting</a> page to troubleshoot activation failures.<p>';
                    return;
                }

                $rc = update_option( 'madtek_entrusans_spvk', $keys['spvk'] );
                if (!$rc) {
                  echo 'Error 206 - insert error<p>Activation failed see <a href="https://madtek.com/content/troubleshooting-entrusans%E2%84%A2-ids-activation">the Entrusans IDS troubleshooting</a> page to troubleshoot activation failures.<p>';
                  return;
                }

                $rc = update_option( 'madtek_entrusans_license', $keys['license_key'] );
                if (!$rc) {
                  echo 'Info 207 - Existing license key dectected<p>Activation proceeded <a href="https://madtek.com/content/troubleshooting-entrusans%E2%84%A2-ids-activation">the Entrusans IDS troubleshooting</a> page to troubleshoot activation messages.<p>';
                }

                $rc = update_option( 'madtek_entrusans_status', 'connected' );
                if (!$rc) {
                  echo 'Info 208 - connected<p>Activation abandoned <a href="https://madtek.com/content/troubleshooting-entrusans%E2%84%A2-ids-activation">the Entrusans IDS troubleshooting</a> page to troubleshoot activation messages.<p>';
                  return;
                }

                echo "Entrusans IDS activated<p><p>";
                echo 'Please check your email for a First Scan email message that signals activation confirmation. It may take several minutes following activation for the email to arrive in your email box. Click <a href="https://madtek.com">here</a> to return to the Entrusans IDS home page';

              } else {
                echo 'Error 301 - Activation failed<p>see <a href="https://madtek.com/content/troubleshooting-entrusans%E2%84%A2-ids-activation">the Entrusans IDS troubleshooting</a> page to troubleshoot activation failures.<p>';
              
              }
            }
          } else {

          ?>
            <h3>Entrusans&trade; Intrusion Detection Service</h3>

            <div class="entrusans-info">

            <form method="POST" action="">
               <p>Enter the Entrusans IDS license key from order email and email address used for purchase and click Activate button to proceed.</p>
               License Key : <input type="text" name="licensekey" size="36">
               Email : <input type="text" name="emailaddr" size="50" maxlength="254">
               <input type="submit" value="Activate" class="button button-primary button-large">
            </form>
            </div>
          <?php  
          } // end if 
          break;

        case "deactivated":
        ?>
          <h3>Entrusans&trade; Intrusion Detection Service</h3>
        <?php
          $lkey = $wpdb->get_option( 'madtek_entrusans_license' );
        ?>
          <h4>Status: Deactivated</h4>
          <div class="entrusans-info">
          <h4>License Key: <?php echo $lkey ?></h4></p>
          </div>
        <?php
          break;
        
        case "cancelled":
        ?>
          <h3>Entrusans&trade; Intrusion Detection Service</h3>
        <?php
          $lkey = $wpdb->get_option( 'madtek_entrusans_license' );
        ?>
          <h4>Status: Cancelled</h4>
          <div class="entrusans-info">
          <h4>License Key: <?php echo $lkey ?></h4></p>
          </div>
        <?php
          break;

        default:
          break;

      } // end switch

    } // end entrusans_admin_page

} // end class Madtek_Entrusans

?>
