<?php
if ( !defined( 'ABSPATH' ) ) exit;

function cgarb_get($name) {
	if(isset($_GET[$name])) {
		return $_GET[$name];
	} else {
		return "";
	}
}

function cgarb_post($name) {
	if(isset($_POST[$name])) {
		return $_POST[$name];
	} else {
		return "";
	}
}

function cgarb_session($name) {
	if(isset($_SESSION[$name])) {
		return $_SESSION[$name];
	} else {
		return "";
	}
}

function shuffle_the_puzzle($array) {
	$old_array = $array;
	$array = shuffle_with_keys($array);
	if($old_array === $array) {
		$array = shuffle_the_puzzle($array);
	} 
	return $array;
}

function shuffle_with_keys($array) { 
	$aux = array(); 
	$keys = array_keys($array); 
	shuffle($keys); 
	foreach($keys as $key) { 
		$aux[$key] = $array[$key]; 
		unset($array[$key]); 
	} 
	$array = $aux;
	return $array;
}

function arand() {
	$letters = array_merge(range('a','z'),range('A','Z'));
	return $letters[rand(0,51)];
}
?>