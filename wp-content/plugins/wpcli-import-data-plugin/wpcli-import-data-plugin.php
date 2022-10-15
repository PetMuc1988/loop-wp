<?php
/**
 * Plugin Name:     WP-CLI Import Data Plugin
 * Plugin URI:      https://peter-kaltenberger.de/
 * Description:     This is a wp-cli plugin to import custom data
 * Author:          wp-cli
 * Author URI:      https://peter-kaltenberger.de/
 * Text Domain:     wpcli-import-data-plugin
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Wpcli_Import_Data_Plugin
 */
require('post-types/data.php');

/*
if (defined('WP_CLI') && WP_CLI){
  class WPC_CLI{
    public function generate_data(){
      $amount = 10;
      $progress = \WP_CLI\Utils\make_progress_bar('Generating Data', $amount);

      for($i=0; $i<$amount; $i++){
        wp_insert_post([
          'post_title' => 'Title 3',
          'post_status' => 'publish',
          'post_type' => 'data',
        ]);

        $progress->tick();
      }

      $progress->finish();
      WP_CLI::success($amount . ' Items generated');
    }
  }

  WP_CLI::add_command('wpc', 'WPC_CLI');
}
*/









if (defined('WP_CLI') && WP_CLI){

  class WPC_CLI{
    public function generate_data(){

      // global $wp_version;
      //
      // $args = array(
      //    'timeout' => 5,
      //    'redirection' => 5,
      //    'httpversion' => '1.0',
      //    'user-agent' => 'WordPress/'.$wp_version.'; '.home_url(),
      //    'blocking' => true,
      //    'body' => null,
      //    'compress' => false,
      //    'decompress' => true,
      //    'sslverify' => false,
      //    'stream' => false,
      //    'filename' => null
      // );

      $request = wp_remote_get( 'https://jsonplaceholder.typicode.com/posts' );

        if( is_wp_error( $request ) ) {
        	return false; // Bail early
        }

        $body = wp_remote_retrieve_body( $request );

        $data = json_decode( $body );

        foreach($data as $item) {
             // New post data object to set as a post
             $new_post = array(
                'post_type' => 'data',
                'post_title' => $item->title,
                'post_status' => 'publish',
                'post_author' => 1,
                'post_content' => $item->body,
                'meta_input' => array(
                'api_id' => $item->id,
                )
             );

             // Insert the post into the database
             wp_insert_post($new_post);

        }



      // $response = wp_remote_get('https://jsonplaceholder.typicode.com/posts', $args);
      // $response = json_encode($response); // Takes a mixed value and converts it to JSON string
      // $data = json_decode($response); // Convert JSON string to PHP variable

      //$progress = \WP_CLI\Utils\make_progress_bar('Generating Data', $amount);

      //foreach($data as $item) {
         // // Check if post exist allready in WP
         // $existing_posts = get_posts(array('post_type' => 'data', 'numberposts' => -1));
         // $api_ids = array();
         // foreach($existing_posts as $post) {
         //    $id = get_post_meta($post->id, 'api_id', true);
         //    array_push($api_ids, $id);
         // }
         //
         // if (in_array($post->id, $api_ids)) {
         //    error_log('post allready exists');
         // } else {
         //
         //    // New post data object to set as a post
         //    $new_post = array(
         //       'post_type' => 'data',
         //       'post_title' => $item->title,
         //       'post_status' => 'publish',
         //       'post_author' => 1,
         //       'post_content' => $item->body,
         //       'meta_input' => array(
         //       'api_id' => $item->id,
         //       )
         //    );
         //
         //    // Insert the post into the database
         //    wp_insert_post($new_post);
         // }


         // New post data object to set as a post
         // $new_post = array(
         //    'post_type' => 'data',
         //    'post_title' => $item->title,
         //    'post_status' => 'publish',
         //    'post_author' => 1,
         //    'post_content' => $item->body,
         //    'meta_input' => array(
         //    'api_id' => $item->id,
         //    )
         // );
         //
         // // Insert the post into the database
         // wp_insert_post($new_post);

      //}

        //$progress->tick();
      }

      //$progress->finish();
      //WP_CLI::success($amount . ' Items generated');
    }

WP_CLI::add_command('wpc', 'WPC_CLI');

  }

















// if (defined('WP_CLI') && WP_CLI){
// class WPC_CLI{
//   public function generate_data(){
//
//    $response = wp_remote_get('https://jsonplaceholder.typicode.com/posts', $args);
//    $response = json_encode($response); // Takes a mixed value and converts it to JSON string
//    $data = json_decode($response); // Convert JSON string to PHP variable
//
//    global $wp_version;
//
//    $args = array(
//       'timeout' => 5,
//       'redirection' => 5,
//       'httpversion' => '1.0',
//       'user-agent' => 'WordPress/'.$wp_version.
//       '; '.home_url(),
//       'blocking' => true,
//       'body' => null,
//       'compress' => false,
//       'decompress' => true,
//       'sslverify' => false,
//       'stream' => false,
//       'filename' => null
//    );
//
//    foreach($data as $item) {
//       // Check if post exist allready in WP
//       $existing_posts = get_posts(array('post_type' => 'post', 'numberposts' => -1));
//       $api_ids = array();
//       foreach($existing_posts as $post) {
//          $id = get_post_meta($item - > ID, 'api_id', true);
//          array_push($api_ids, $id);
//       }
//
//       if (in_array($item - > id, $api_ids)) {
//          error_log('post allready exists');
//       } else {
//
//          // New post data object to set as a post
//          $new_post = array(
//             'post_type' => 'post',
//             'post_title' => $item - > title,
//             'post_status' => 'publish',
//             'post_author' => 1,
//             'post_content' => $item - > body,
//             'meta_input' => array(
//                'api_id' => $item - > id,
//             )
//          );
//
//          // Insert the post into the database
//          wp_insert_post($new_post);
//       }
//    }
// }
//
// }
// WP_CLI::add_command('wpc', 'WPC_CLI');
//
// }
