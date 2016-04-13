<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/facebook-php-sdk/src/Facebook/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login_check.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function facebook_login_php() {
  global $db;
  $fb = new Facebook\Facebook([
    'app_id' => '581406865343052',
    'app_secret' => '894be6b1bb847d273b6080aea4c8b815',
    //'app_id' => '1742198345993041',
    //'app_secret' => '09cc05b64e7dbb8cc394cc2f178bb4e9',
    'default_graph_version' => 'v2.5',
    ]);

  $helper = $fb->getJavaScriptHelper();

  try {
    $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  if (! isset($accessToken)) {
    echo 'No cookie set or no OAuth data could be obtained from cookie.';
    exit;
  }

  $_SESSION['fb_access_token'] = (string) $accessToken;


  try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,email', $_SESSION['fb_access_token']);
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  $user = $response->getGraphUser();

  $fbid = $user['id'];
  $email = $user['email'];

  $query = "SELECT p.display_name AS display_name, p.profile_id AS profile_id, u.role AS role " .
           "FROM profiles p, users u WHERE u.login_id='$email' AND p.profile_id=u.profile_fk";
  $result = $db->query($query);
  echo($query);
  // if user is present
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    set_active_profile($row['profile_id']);
    set_active_display_name($row['display_name']);
    set_active_role($row['role']);
  }
  // add new user if not present
  else {
    $email_array = explode("@", $email);
    $auto_display_name = $email_array[0];
    $insert_profile_query = "INSERT INTO profiles (display_name, image_url) VALUES ('$auto_display_name', '//graph.facebook.com/$fbid/picture')";
    $db->query($insert_profile_query);
    $id = $db->insert_id;
    $insert_user_query = "INSERT INTO users (login_id, profile_fk) VALUES ('$email', $id)";
    $subresult = $db->query($insert_user_query);
    if ($subresult) {
      set_active_profile($id);
      set_active_display_name($auto_display_name);
      set_active_role(0);
    }
  }
}
?>