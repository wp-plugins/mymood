<?php
if ( !defined( 'ABSPATH' ) ) exit;

if(!function_exists("captcha_grab_comment_action")):
	
	function captcha_grab_comment_action($postID) {
		
		if(get_option("cgarb_enable") != "yes"){
		return false;
		}
		
		if(get_option("cgarb_off4_loginin") == "yes"){ //if disabled for loggedin users.
		return false;
		}
				
		if (!session_id()){
		session_start();
		}
				
		$post_code = cgarb_post("captchagarb_code_comment");
		if($post_code == "") {
			unset($_SESSION[$postID."_comment_captchagrab"]);
			wp_die( __('<strong>ERROR</strong>: Please solve the puzzle correctly to post comment.') );
		}

		$session_code = cgarb_session($postID."_comment_captchagrab");
		if($post_code != $session_code) {
			unset($_SESSION[$postID."_comment_captchagrab"]);
			wp_die( __('<strong>ERROR</strong>: Please solve the puzzle correctly to post comment.') );
		}
			unset($_SESSION[$postID."_comment_captchagrab"]);
		return true;		
	}
	
endif; //if(!function_exists("captcha_grab_comment_action")):
?>