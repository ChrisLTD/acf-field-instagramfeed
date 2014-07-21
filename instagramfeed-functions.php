<?php
// function instagram_check_field( $field ) {
//   if ( ( isset($field) && $field != '') ){
//     return true;
//   } else {
//     return false;
//   }
//
// }
// //$apikeys = get_option('acf_instagram');
// /* Store User Id on Update */
// function get_instagram_user_id($username) {
//   $result = get_transient('instagram_user_id_'. $username);
//   if ( empty( $result ) ){
//     if(get_option('acf_instagram')) {
//       $apikeys = get_option('acf_instagram');
//       $access_token  = $apikeys['access_token'];
//       $url = 'https://api.instagram.com/v1/users/search?q='.$username.'&count=1&access_token='.$access_token;
//       $data = wp_remote_retrieve_body(wp_remote_get($url));
//       $response = json_decode(trim(preg_replace('/\s\s+/', ' ', $data)));
//       $result = $response->data[0];
//       set_transient('instagram_user_id_'. $username, $result, YEAR_IN_SECONDS ); //1 Year
//     }
//     //set_transient('instagram_user_id_'. $username, $result, 365 * 24 * 60 * 60 ); //1 Year
//   } else {
//     return $result = get_transient('instagram_user_id_'. $username);
//
//   }
//
// }
//
// /* Store Transient On Updates */
// function store_instagram_feed($endpoint, $count, $cache_key) {
//   if(get_option('acf_instagram')) {
//     $apikeys       = get_option('acf_instagram');
//     $access_token  = $apikeys['access_token'];
//     $data_arr   = array('count'=>$count,'access_token'=>$access_token);
//     $data_query = http_build_query($data_arr) . "\n";
//     $url = 'https://api.instagram.com/v1/'.trim($endpoint, "/").'?'.$data_query;
//     $data = wp_remote_retrieve_body(wp_remote_get($url));
//     if($data) {
//       $response = json_decode(trim(preg_replace('/\s\s+/', ' ', $data)));
//       $result = $response;
//       set_transient($cache_key, $result, 60 * 60 * 6 ); //6 hours
//     }
//   }
//
// }
//
//
// function get_instagram_response($cache_key) {
//   $result = get_transient($cache_key);
//   if ( empty( $result ) ){
//     $result = '';
//   } else {
//     $response = get_transient($cache_key);
//     $result = json_encode($response);
//    // $result = json_encode($response->data);
//
//   }
//   return $result;
// }
//
//
//
// /* Retrive Items Data */
// function get_instagram_html($cache_key) {
//   $result = get_transient($cache_key);
//   if ( empty( $result ) ){
//     return '';
//   } else {
//     $response = get_transient($cache_key);
//     $items = $response->data;
//     $item = $items[0]->images->standard_resolution->url;
//     return $item;
//   }
//
// }
//
// /* View the feed in Admin */
// function display_instagram_media($cache_key) {
//   if ( false === ( $value = get_transient($cache_key) ) ) {
//     echo $cache_key. 'Not Found';
//   } else {
//     $response = get_transient($cache_key);
//     $images = $response->data;
//     if($images){
//       $cnt=0;
//       foreach($images as $item):
//           $cnt++;
//           $title = (isset($item->caption)) ? mb_substr($item->caption->text,0,70,"utf8"):null;
//           if($cnt==1) {
//             // echo '<pre>';
//             // print_r($item);
//             // echo '</pre>';
//           }
//           echo '<div class="thumbnail">';
//             echo '<a href="'.$item->link.'" target="_blank" class="inner clearfix">';
//             if($item->type == 'video') {
//                 $size = 'low_resolution'; // 640 x 640  &  612 x 612
//                 echo '<video src="'.htmlspecialchars($item->videos->$size->url).'" style="height:auto;max-width:150px;"></video>';
//             } else {
//                 $size = 'thumbnail'; // 640 x 640  &  612 x 612
//                 echo '<img src="'.htmlspecialchars($item->images->$size->url).'" class="hmedia" style="display:block;height:auto;max-width:150px;">';
//             }
//             echo '<div class="info">';
//             echo '<p>'.$title.'</p>';
//             echo '<p>'.date("Y.m.d - h:i",$item->created_time).'</p>';
//             echo '</div>';
//             echo '</a>';
//           echo '</div>';
//           echo (($cnt % 4) == 0) ? '<div class="clearfix"></div>' : '';
//       endforeach;
//     } else {
//       echo 'no images :( <br>';
//       echo '<pre>';
//       print_r($response);
//       echo '</pre>';
//     }
//   }
// }
?>
