<?php
if ( !defined( 'ABSPATH' ) ) exit;


if(!function_exists("captchagarb_comment_form")):

function captchagarb_comment_form($postID) {

if(get_option("cgarb_enable") != "yes"){
	return false;
}
if(get_option("cgarb_off4_loginin") == "yes") {
	return false;
}

$out = '
<div class="captchagarb" id="captchagarb">
<span class="puzit">Drag it to solve it</span>
<img src="'.CAPTCHAGARB_PATH.'/loader.gif" style="display:none;" class="loader"/>
<div class="puz_container">

</div>
<a href="javascript:load_puzzle()" class="refr"> Refresh </a>
</div>
<input type="hidden" id="captchagarb_code_comment" name="captchagarb_code_comment"/>
';
$out = str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$out), "\0..\37'\\"))); 

echo '
<style type="text/css">
'.get_option("cgarb_css").'
</style>
<script type="text/javascript" src="'.CAPTCHAGARB_PATH.'/jquery-ui.js"></script>
<script type="text/javascript">

function load_puzzle() {
	jQuery("#captchagarb").find(".loader").css("display","block");
	jQuery.post("?captchagrab=get_puzzle", {postID: "'.$postID.'"},
 	function(d) {
	jQuery("#captchagarb").find(".loader").hide();
    jQuery.globalEval(d);
 	jQuery("#captchagarb").find(".puz_container").find("ul").sortable({ scroll: false ,containment: "parent",tolerance: "pointer", update:function() { 
	code_var = "";
	jQuery("#captchagarb").find("li").each(function() {
	if(code_var == ""){
		code_var = jQuery(this).attr("id");
	} else {
		code_var = code_var+"|"+jQuery(this).attr("id");
	}
	});
	jQuery("#captchagarb_code_comment").val(code_var);
	}});
	});
	
}
jQuery("textarea[name=\'comment\']").after("'.$out.'");

jQuery("document").ready(function() {  load_puzzle(); jQuery("#captchagarb_ver").hide(); });


</script>
<p style="font-size:2px;color:gray;" id="captchagarb_ver">Captcha Garb ('.CAPTCHAGARB_VERSION.')</p>
<script type="text/javascript">

</script>
';				

}

endif; //if(!function_exists("captchagarb_comment_form")):


if(!function_exists("captcha_grab_init_get_puzzle")):	
	
	function captcha_grab_init_get_puzzle() {
	
		if(get_option("cgarb_enable") != "yes"){
		return false;
		}

		if (!session_id()){
				session_start();
		}
	
		if(!isset($_GET["captchagrab"])) {
			return false;
		}
		
		if($_GET["captchagrab"] == "get_puzzle") { 
		
		if(cgarb_post("postID") == "") {
			echo 'alert("Unexpected Error");';
			exit;
		}
		if(!is_numeric(cgarb_post("postID"))) {
			echo 'alert("Unexpected Error");';
			exit;
		}
		$postID = cgarb_post("postID");
		
		unset($_SESSION[$postID."_comment_captchagrab"]); //unset old session if any
		
		$captcha_key = array(arand().uniqid(),arand().uniqid(),arand().uniqid(),arand().uniqid());
		
		$puzzle[$captcha_key[0]] = 'background-position:0px 0px;';		
		$puzzle[$captcha_key[1]] = 'background-position:75px 0px;';		
		$puzzle[$captcha_key[2]] = 'background-position:0px 75px;';		
		$puzzle[$captcha_key[3]] = 'background-position:75px 75px;';	
		
		$_SESSION[$postID."_comment_captchagrab"] = implode("|",$captcha_key);
		
		$puzzle = shuffle_the_puzzle($puzzle); //lets mix up
		
		$out = '<style type="text/css">
		.captchagarb .puz_container ul { overflow:hidden;list-style:none; }
		.captchagarb .puz_container ul li { display:block; background-image:url(?captchagrab=puzimg&i='.uniqid().');  float:left; width:75px; height:75px; overflow:hidden; margin:0px; padding:0px; clear:none; }';
		foreach($puzzle as $key => $css) {
			$out .= ' #'.$key.' { '.$css.' }';
		}		
		$out .= '</style>';
		$out .= '<ul>';
		foreach($puzzle as $class => $css) {
		$out .= '<li id="'.$class.'"></li>';
		}
		$out .= '</ul>';
		$out = str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$out), "\0..\37'\\"))); 
		echo 'jQuery(".captchagarb").find(".puz_container").html("").append("'.$out.'");';
			exit;
		}
		
	}
	
endif; //if(!function_exists("captcha_grab_init_get_puzzle")):

if(!function_exists("captcha_grab_init_get_puzzleimg")):

function captcha_grab_init_get_puzzleimg() {
	
	if(!isset($_GET["captchagrab"])) {
			return false;
		}
		
		if($_GET["captchagrab"] == "puzimg") { 
		
		$puzzle_images = array_diff(scandir(CAPTCHAGARB_DIR."/puzzle/"), array('..', '.'));
		shuffle($puzzle_images);
		$rand_key = array_rand($puzzle_images,1);
		$get_img = file_get_contents(CAPTCHAGARB_DIR."/puzzle/".$puzzle_images[$rand_key]);
		header('Content-type: image/jpg');
		echo $get_img;
		exit;
		}
	
	
}

endif;  //if(!function_exists("captcha_grab_init_get_puzzleimg")):

?>