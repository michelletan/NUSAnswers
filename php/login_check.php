<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/constants.php';

// require_once $_SERVER['DOCUMENT_ROOT'] . '/php/Facebook/src/Facebook/autoload.php';
//
// $fb = new Facebook\Facebook([
  // 	'app_id' => '581406865343052',
  // 	'app_secret' => '894be6b1bb847d273b6080aea4c8b815',
  // 	'default_graph_version' => 'v2.5'
// ]);
//
//  	$helper = $fb->getJavascriptHelper();
//  	$access_token = $helper->getAccessToken();

function set_active_profile($profile_id) {
	$_SESSION['profile'] = $profile_id;
}

function set_active_display_name($display_name) {
	$_SESSION['display_name'] = $display_name;
}

function set_active_role($role) {
	$_SESSION['role'] = $role;
}

function get_active_profile() {
	if (isset($_SESSION['profile'])) {
		return $_SESSION['profile'];
	}
	else {
		return null;
	}
}

function get_active_display_name() {
	if (isset($_SESSION['display_name'])) {
		return $_SESSION['display_name'];
	}
	else {
		return null;
	}
}

// roles:
function get_active_role() {
	if (isset($_SESSION['role'])) {
		return $_SESSION['role'];
	}
	else {
		return null;
	}
}

function has_admin_rights() {
	if (isset($_SESSION['role']) && $_SESSION['role'] >= USER_ROLE_ADMIN) {
		return true;
	}
	else {
		return false;
	}
}

function has_mod_rights() {
	if (isset($_SESSION['role']) && $_SESSION['role'] >= USER_ROLE_MOD) {
		return true;
	}
	else {
		return false;
	}
}

function is_logged_in() {
	return isset($_SESSION['profile']) && isset($_SESSION['display_name']) && isset($_SESSION['role']);
}

function logout_active_session() {
	unset($_SESSION['profile']);
	unset($_SESSION['display_name']);
	unset($_SESSION['role']);
}
?>
