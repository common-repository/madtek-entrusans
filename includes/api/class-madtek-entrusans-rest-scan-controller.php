<?php
/**
 * REST Controller
 *
 * This class extends `WP_REST_Controller` in order to enable safe external access
 * to the MadTek Entrusans IDS client.
 *
 * It's required to follow "Controller Classes" guide before extending this class:
 * <https://developer.wordpress.org/rest-api/extending-the-rest-api/controller-classes/>
 *
 *
 * @class   Madtek_Entrusans_REST_Controller
 * @package madtek-entrusans
 * @see     https://developer.wordpress.org/rest-api/extending-the-rest-api/controller-classes/
 */

if ( ! defined( 'ABSPATH' ) ) {
     exit;
}

/**
 * Abstract Rest Controller Class
 *
 * @package  madtek-entrusans
 * @extends  WP_REST_Controller
 * @version  1.0.0
 */
class Madtek_Entrusans_REST_Controller extends WP_REST_Controller {
/**
 * Endpoint namespace.
 *
 * @var string
 */
 protected $namespace = 'madtek/entrusans/v1';

 /**
  * Route base.
  *
  * @var string
  */
  protected $rest_base = '';

  public function __construct() {
    // WP REST API.
    $this->rest_api_init();
  }

  public function rest_api_init() {
    // REST API was included starting WordPress 4.4.

    if ( ! class_exists( 'WP_REST_Server' ) ) {
         return;
    }

    // Init REST API routes.
    add_action( 'rest_api_init', array( $this, 'register_rest_routes' ), 10 );
  }

  public function register_rest_routes()
  {
    $rc = register_rest_route(
                              'madtek/entrusans/',
                              'v1',
                              array(
                                    'methods' => WP_REST_Server::READABLE,
                                    'callback' => array($this, 'handle_api_request'),
                               ) );
  }

  function getSiteMetaData( $filter )
  {

    $start = time();

    $root = $_SERVER['DOCUMENT_ROOT'];

    $iter = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS)
                , RecursiveIteratorIterator::SELF_FIRST
                , RecursiveIteratorIterator::CATCH_GET_CHILD );

    $paths = array($root);

    $data  = array( "content" => array(),
                  "prelude" => array( "host" => "Entrusans client", "answer" => "the secret question"), );

    $stat = stat($root);
    $array = array($stat['ctime'],"DIRECTORY","..");
    array_push( $data["content"], $array );

    foreach ($iter as $path => $dir) {
        if ($dir->isDir()) {
            $stat = stat($path);
            $array = array($stat['ctime'],"DIRECTORY",str_replace($root,'',$path));
        } else {
            if (!preg_match("/\.($filter)$/", $path)) {
                $stat = stat($path);
                $array = array($stat['ctime'],"FILE",str_replace($root,'',$path));
            } else {
                $stat = stat($path);
                $array = array($stat['ctime'],md5_file($path),str_replace($root,'',$path));
            }
        }
        array_push( $data["content"], $array );
    }
    $stop = time();
    $data["prelude"]["start"] = $start;
    $data["prelude"]["stop"]  = $stop;
    $data["prelude"]["version"] = 2;
    $data["prelude"]["doc_root"] = 'wordpress';

    return json_encode($data);

  } // end getSiteMetaData

  function handle_api_request () {

    global $wpdb;

    $spvk = get_option( 'madtek_entrusans_spvk' );

    if ($spvk) {
      $spvk = openssl_get_privatekey($spvk);

      if (!$_GET['cmd']) {
        return new WP_Error( 'page_does_not_exist', __('The page you are looking for does not exist'), array( 'status' => 404 ) );
      }

      if ( !preg_match('/^(?:[A-Za-z0-9+\/]{4})*(?:[A-Za-z0-9+\/]{2}==|[A-Za-z0-9+\/]{3}=)?$/', $_GET['cmd']) ) {
        return new WP_Error( 'page_does_not_exist', __('The page you are looking for does not exist'), array( 'status' => 404 ) );
      }

      if (!$_GET['env']) {
        return new WP_Error( 'page_does_not_exist', __('The page you are looking for does not exist'), array( 'status' => 404 ) );
      }

      if ( !preg_match('/^(?:[A-Za-z0-9+\/]{4})*(?:[A-Za-z0-9+\/]{2}==|[A-Za-z0-9+\/]{3}=)?$/', $_GET['env']) ) {
        return new WP_Error( 'page_does_not_exist', __('The page you are looking for does not exist'), array( 'status' => 404 ) );
      }

      if ( ($cmd = base64_decode(rawurldecode($_GET['cmd']) ) ) && ($envk = base64_decode(rawurldecode($_GET['env']) ) ) ) {

        $rc = openssl_open($cmd, $msg, $envk, $spvk);

        if ($rc) {

          $msg_parts = preg_split("/,/", $msg);

          if ($msg_parts[0] === 'READY') {

            $sitedata = $this->getSiteMetaData($msg_parts[1]);

            $ekey = array("");

            $cpbk = get_option( 'madtek_entrusans_cpbk' );
            if ($cpbk) {
              $cpbk = openssl_get_publickey($cpbk);

              openssl_seal($sitedata, $response, $ekey, array($cpbk));

              $message = base64_encode($response);
              $envkey  = base64_encode($ekey[0]);

              $return = array('env' => $envkey, 'msg' => $message);

              return (rest_ensure_response($return));

            } else {
              return new WP_Error( 'page_does_not_exist', __('The page you are looking for does not exist'), array( 'status' => 404 ) );
            }
          } else {
            return new WP_Error( 'page_does_not_exist', __('The page you are looking for does not exist'), array( 'status' => 404 ) );
          }
        } else {
          return new WP_Error( 'page_does_not_exist', __('The page you are looking for does not exist'), array( 'status' => 404 ) );
        }
      } else {
        return new WP_Error( 'page_does_not_exist', __('The page you are looking for does not exist'), array( 'status' => 404 ) );
      }
    } else {
      return new WP_Error( 'page_does_not_exist', __('The page you are looking for does not exist'), array( 'status' => 404 ) );
    }
  }
} // Madtek_Entrusans_REST_Controller
