<?php
/* AJAX action callback */
add_action( 'wp_ajax_number_tracking', 'number_tracking_ajax_callback' );
add_action( 'wp_ajax_nopriv_number_tracking', 'number_tracking_ajax_callback' );
/* Ajax Callback */
function number_tracking_ajax_callback () {
    global $mos_tcpalitigatorlist_options;
    $phone = $_POST['phone'];
    $type = $_POST['type'];
    
    
    $api_endpoint = 'https://api.tcpalitigatorlist.com/scrub/phone/'.$type.'/'.$phone;//3015023260,6467366633
    $api_username=$mos_tcpalitigatorlist_options['username'];
    $api_password=$mos_tcpalitigatorlist_options['password'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$api_username:$api_password");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $response_array = json_decode($output,true);
    
	echo json_encode($response_array['match'][$phone]['type']);
    exit; // required. to end AJAX request.
}