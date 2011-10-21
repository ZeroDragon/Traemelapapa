<?php
session_start();
/*
 Below is a very simple and verbose PHP 5 script that implements the Engage token URL processing and some popular Pro/Enterprise examples.
 The code below assumes you have the CURL HTTP fetching library with SSL.  
*/

//For a production script it would be better to include the apiKey in from a file outside the web root to enhance security.
$rpx_api_key = 'd213ae3e32904a5b51796ac5d7ae4e035289c823';

/*
 Set this to true if your application is Pro or Enterprise.
 Set this to false if your application is Basic or Plus.
*/
$engage_pro = false;

/* STEP 1: Extract token POST parameter */
$token = $_POST['token'];

//Some output to help debugging
// echo "SERVER VARIABLES:\n";
// print_r($_SERVER);
// echo "HTTP POST ARRAY:\n";
// print_r($_POST);

if(strlen($token) == 40) {//test the length of the token; it should be 40 characters

  /* STEP 2: Use the token to make the auth_info API call */
  $post_data = array('token'  => $token,
                     'apiKey' => $rpx_api_key,
                     'format' => 'json',
                     'extended' => 'true'); 

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_URL, 'https://rpxnow.com/api/v2/auth_info');
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_FAILONERROR, true);
  $result = curl_exec($curl);
  if ($result == false){
    echo "\n".'Curl error: ' . curl_error($curl);
    echo "\n".'HTTP code: ' . curl_errno($curl);
    echo "\n"; var_dump($post_data);
  }
  curl_close($curl);


  /* STEP 3: Parse the JSON auth_info response */
  $auth_info = json_decode($result, true);

  if ($auth_info['stat'] == 'ok') {
    // echo "\n auth_info:";
    // echo "\n"; prinr_r($auth_info);

    /* 
	array(2) { ["profile"]=> array(7) { ["photo"]=> string(63) "http://a2.twimg.com/profile_images/1212552315/avatar_normal.JPG" ["name"]=> array(1) { ["formatted"]=> string(15) "Zero the Dragon" } ["displayName"]=> string(15) "Zero the Dragon" ["preferredUsername"]=> string(10) "zerodragon" ["url"]=> string(29) "http://twitter.com/zerodragon" ["providerName"]=> string(7) "Twitter" ["identifier"]=> string(51) "http://twitter.com/account/profile?user_id=14735696" } ["stat"]=> string(2) "ok" }
    */
	$_SESSION['avatar'] = $auth_info['profile']['photo'];
	$_SESSION['name'] = $auth_info['profile']['preferredUsername'];
	$_SESSION['url'] = $auth_info['profile']['url'];

    } else {
      // Gracefully handle auth_info error.  Hook this into your native error handling system.
      echo "\n".'An error occured: ' . $auth_info['err']['msg']."\n";
      var_dump($auth_info);
      echo "\n";
      var_dump($result);
    }
}else{
  // Gracefully handle the missing or malformed token.  Hook this into your native error handling system.
  echo 'Authentication canceled.';
}
echo "<script>window.location = '../'</script>"
?>