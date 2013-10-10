<?php
/*
	Plugin Name: IMAP-Login
	Plugin URI: https://github.com/josebmera/
	Plugin Description: Allows users to login in Q2A through an email server
	Plugin Version: 0
	Plugin Date: 2013-09-28
	Plugin Author: Jose Mª Bermudo Mera
	Plugin Author URI:
	Plugin License: Free
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Minimum PHP Version: 
	Plugin Update Check URI:
*/
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

qa_register_plugin_module('login','imap-login.php','imap_login','IMAP Login');
qa_register_plugin_layer('imap-login-layer.php','IMAP Login Layer');



/*
	Omit PHP closing tag to help avoid accidental output
*/