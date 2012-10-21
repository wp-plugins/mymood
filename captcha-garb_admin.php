<?php
if ( !defined( 'ABSPATH' ) ) exit;

add_action('admin_menu', 'captcha_garb_admin_option');
function captcha_garb_admin_option() {
  add_options_page('Captcha Garb Settings','Captcha Garb', 10,__FILE__, 'captcha_garb_admin_page');
}



function captcha_garb_admin_page() {  ?>

<?php

if( !current_user_can( 'manage_options' ) )  
{ 
_e('<div id="message" class="error fade">
		  <p>
		    <strong>You have no permission to access this page !</strong>
		  </p>
		</div>');
return true; 
}

?>

<style>
/* MESSAGE BOXES
/////////////////////////////*/
.a_clean,.a_info,.a_ok,.a_alert,.a_error { text-align: center; padding: 5px; color:#545454; width:80%;  margin:5px auto; }
.a_clean { background-color: #efefef; border-top: 2px solid #dedede; border-bottom: 2px solid #dedede; }
.a_info  { background-color: #f7fafd; border-top: 2px solid #b5d3ff; border-bottom: 2px solid #b5d3ff; }
.a_ok    { background-color: #d7f7c4; border-top: 2px solid #82cb2f; border-bottom: 2px solid #82cb2f; }
.a_alert { background-color: #fef5be; border-top: 2px solid #fdd425; border-bottom: 2px solid #fdd425; }
.a_error { background-color: #ffcdd1; border-top: 2px solid #e10c0c; border-bottom: 2px solid #e10c0c; }
</style>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>

<h2>Captcha Garb (<?php echo CAPTCHAGARB_VERSION; if(CAPTCHAGARB_VERSION <= 2) { echo " <sup>BETA</sup>"; } ?>) <?php _e("Settings"); ?></h2>
<div style="clear:both"></div>

<div class="postbox-container" style="width:70%">
<p>Currently Captcha Garb is only for comment, new versions will come with new puzzles & features :).</p>

<?php
if(isset($_POST["Update"])) {

if(cgarb_post("cgarb_enable") == "yes") {
	update_option("cgarb_enable","yes");
} else {
	update_option("cgarb_enable","no");
}	

if(cgarb_post("cgarb_off4_loginin") == "yes") {
	update_option("cgarb_off4_loginin","yes");
} else {
	update_option("cgarb_off4_loginin","no");
}	

	update_option("cgarb_css",cgarb_post("cgarb_css"));

echo '<div class="updated"><p>Setting Saved.</p></div>';
}

?>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class="form-table">

<tr valign="top">
<th scope="row">Enable :</th>
<td>
<label><input name="cgarb_enable" type="checkbox" value="yes" <?php if(get_option("cgarb_enable") == "yes"): ?> checked="checked" <?php endif; ?>> </label>
</td>
</tr>

<tr valign="top">
<th scope="row">Disable for Loginin Users :</th>
<td>
<label><input name="cgarb_off4_loginin" type="checkbox" value="yes" <?php if(get_option("cgarb_off4_loginin") == "yes"): ?> checked="checked" <?php endif; ?>> </label>
</td>
</tr>

<tr valign="top">
<th scope="row">CSS Style :</th>
<td>
<label>
<textarea style="width:100%;height:200px" name="cgarb_css"><?php echo get_option("cgarb_css"); ?></textarea>
</label>
</td>
</tr>

  <tr>
    <td height="26">&nbsp;</td>
    <td>
      <input type="submit" name="Update" class="button-primary" value="Update" />
    </td>
  </tr>
</table></form>

<div id="manage_puzzle"><br /></div><h3>Manage Puzzle Images</h3>

<?php
if(isset($_FILES["cgarb_new_image"])) {

if ($_FILES["cgarb_new_image"]["error"] > 0){
  echo "<div class='a_ok'><p>Error while uploading image <br /> Error: " . $_FILES["cgarb_new_image"]["error"] . "</p></div>";
} else {

$ext = explode(".",$_FILES["cgarb_new_image"]["name"]);
$ext = strtoupper(end($ext));

if($ext == "JPEG" || $ext == "PNG" || $ext == "JPG") {
	
	if(!list($width, $height, $type, $attr) = getimagesize($_FILES["cgarb_new_image"]["tmp_name"])) {
		echo "<div class='a_error'><p>Uploaded image is invalid.</p></div>";
	} else {
		if($width == "150" and $height == "150") {
		
		 move_uploaded_file($_FILES["cgarb_new_image"]["tmp_name"],CAPTCHAGARB_DIR."/puzzle/".uniqid().".".$ext);
		 echo "<div class='a_ok'><p>Image has been uploaded succesfully.</p></div>";
		 
		} else {
			echo "<div class='a_error'><p>Image size must be 150pxx150px.</p></div>";
		}
	}
	

	
} else {
	echo "<div class='a_error'><p>Only Jpeg and Png allowed.</p></div>";
}


	
}

	
}
?>

<form enctype="multipart/form-data" method="post"  action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<label>Upload New Image :</label><input type="file" name="cgarb_new_image"/><input type="submit" name="Upload" value="Upload"/>
<p>Image size must be 150x150 and only jpeg and png images are allowed. </p>
</form>


<?php 

if(isset($_POST["cgarb_puzzle_del"]) AND cgarb_post("cgarb_puzzle_del") != "") {
	if(file_exists(CAPTCHAGARB_DIR."/puzzle/".cgarb_post("cgarb_puzzle_del"))) {
		if(unlink(CAPTCHAGARB_DIR."/puzzle/".cgarb_post("cgarb_puzzle_del"))) {
			echo '<br /><div class="a_ok"><p>Image has been deleted.</p></div>';
		} else {
			echo '<br /><div class="a_error"><p>There is error while deleting image.</p></div>';
		}
	}
}
$puzzle_images = array_diff(scandir(CAPTCHAGARB_DIR."/puzzle/"), array('..', '.'));
?>



<?php
echo '<p> Currently there are ( '.count($puzzle_images).' ) Images. </p>';

foreach($puzzle_images as $puzzle_images) {
	echo '<div class="cgarb-puzzle-img"> <img src="'.CAPTCHAGARB_PATH.'/puzzle/'.$puzzle_images.'" /> 
	<form method="post" action="'.$_SERVER['REQUEST_URI'].'#manage_puzzle">
	<input type="hidden" name="cgarb_puzzle_del" value="'.$puzzle_images.'"/>
	<input type="submit" name="submit" value="Delete" style="background:#dedcdc;color:#61585c;padding:4px;"/>
	</form></div>';
}

?>
<style>
.cgarb-puzzle-img {
	width:150px;
	height:180px;
	float:left;
	text-align:center;
}
</style>

</div></div>

<!-- NEWS -->
<div class="postbox-container" style="width:28%">

 <center>
 <a href="http://webgarb.com/captcha-garb/" target="_blank" title="Captcha Garb HomePage"><img src="<?php echo CAPTCHAGARB_PATH."/logo.png"; ?>" border="0">
 </a> 
 </center>
 <p>
 Follow WebGarb on twitter.
 </p>
 <a href="https://twitter.com/webgarb" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @webgarb</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<p>
Tell about this plugin to your followers.
</p>
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://webgarb.com/captcha-garb/" data-text="BudyyPress MyMood plugin for BuddyPress" data-via="webgarb" data-size="large" data-hashtags="WordPress">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<p>
Latest Update.
</p>
 <!--Twitter-->
<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 10,
  interval: 30000,
  width: 'auto',
  height: 500,
  theme: {
    shell: {
      background: 'transparent',
      color: '#ba0000'
    },
    tweets: {
      background: 'transparent',
      color: '#878787',
      links: '#0073ff'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: false,
    behavior: 'all'
  }
}).render().setUser('webgarb').start();
</script>
<!--End Twitter-->
 
</div>
<div class="clear"></div>

<!-- NEW END -->



<h3>Need Help ? Visit <a href="http://webgarb.com/captcha-garb/">Captcha Garb</a> HomePage <a href="http://webgarb.com/captcha-garb/">http://webgarb.com/captcha-garb/</a></h3>

<span class="description"><a href="http://webgarb.com/captcha-garb/">Captcha Garb</a> &copy; Copyright 2009 - 2012 <a href="http://webgarb.com">Webgarb.com</a>. Captcha Garb Contain Graphic are property of their respective owner.<br />
</span>

<?php
} //End admin panel
?>