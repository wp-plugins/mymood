<?php /*
Plugin Name: MyMood
Plugin URI:  http://webgarb.com/?s=Mymood
Description: Display your Mood/Status to in your sidebar using widget to your visitor.
Version: 1.2
Author: Webgarb
Author URI: http://Webgarb.com
*/

register_activation_hook(__FILE__, 'mymood_activ');
add_action('admin_menu', 'mymood_adminoption');

function mymood_activ() {

add_option("mymood_news","");
add_option("mymood_news_date","");
add_option("mymood_smiley","11.gif");
add_option("mymood_status","Happy");
add_option('mymood_smiley_show','1');
add_option("mymood_mood_text","Mood :");
add_option('mymood_separator_color','adadad');
add_option('mymood_separator_show','1');
add_option('mymood_status_show','1');
add_option('mymood_widget_title','My Mood Status');

add_option("mymood_else","YAY !! I have just Install MyMood Plugin !");
return true;
}
function mymood_adminoption() {
  
  add_options_page('MyMood Plugin option area','MyMood', 7,__FILE__, 'mymood_adminpanel');

  }
  
  
  
  
function mymood_adminpanel() {  ?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>

<h2>MyMood (1.2) <?php _e("Settings"); ?></h2>
<div style="clear:both"></div>
<?php
 
$mymood_moods = array('None', 'Afraid', 'Amazed', 'Angry', 'Annoyed', 'Anxious', 'Aroused', 'Ashamed', 'Accomplished', 'Aggravated', 'Alone', 'Amused', 'Apathetic', 'Awake', 'Accepted', 'Bored', 'Brave', 'Bewildered', 'Bitchy', 'Bittersweet', 'Blah', 'Blank', 'Blissful', 'Bouncy', 'Calm', 'Cold', 'Confused', 'Contented', 'Curious', 'Cheerful', 'Chipper', 'Complacent', 'Content', 'Cranky', 'Crappy', 'Crazy', 'Crushed', 'Cynical', 'Depressed', 'Disappointed', 'Disgusted', 'Distracted', 'Dark', 'Determined', 'Devious', 'Dirty', 'Discontent', 'Ditzy', 'Dorky', 'Drained', 'Drunk', 'Embarrassed', 'Excited', 'Ecstatic', 'Energetic', 'Enraged', 'Enthralled', 'Envious', 'Exanimate', 'Exhausted', 'Flirtations', 'Frustrated', 'Flirty', 'Full', 'Grumpy', 'Guilty', 'Geeky', 'Giddy', 'Giggly', 'Gloomy', 'Good', 'Grateful', 'Groggy', 'Grumpy', 'Guilty', 'Happy', 'Hot', 'Humbled', 'Humiliated', 'Hungry', 'Hurt', 'High', 'Hopeful', 'Hyper', 'Impressed', 'In awe', 'In love', 'Indignant', 'Interested', 'Intoxicated', 'Invincible', 'Indescribable', 'Indifferent', 'Infuriated', 'Irate',  'Jealous', 'Jubilant', 'Lonely', 'Lazy', 'Lethargic', 'Listless', 'Loved', 'Mean', 'Moody', 'Mad', 'Melancholy', 'Mellow', 'Mischievous', 'Moody', 'Morose', 'Nervous', 'Neutral', 'Naughty', 'Nerdy', 'Not Specified', 'Numb', 'Offended', 'Optimistic', 'Playful', 'Proud', 'Peaceful', 'Pessimistic', 'Pissed off', 'Pleased', 'Predatory', 'Quixotic', 'Relieved', 'Remorseful', 'Restless', 'Recumbent', 'Refreshed', 'Rejected', 'Rejuvenated', 'Relaxed', 'Relieved', 'Rushed', 'Sad', 'Sarcastic', 'Serious', 'Shocked', 'Shy', 'Sick', 'Sleepy', 'Stressed', 'Surprised', 'Satisfied', 'Silly', 'Smart', 'Thristy', 'Thankful', 'Tired', 'Touched', 'Uncomfortable', 'Weird', 'Worried');
//This Mood taken From CurrentStatus Thanks :)
if($_POST[Update] == true) {
update_option('mymood_smiley', $_POST['mymood_smiley']);
update_option('mymood_status', $_POST['mymood_status']);
update_option('mymood_else',stripslashes($_POST['mymood_else']));
update_option('mymood_mood_text', stripslashes($_POST['mymood_mood_text']));
update_option('mymood_separator_color',$_POST["mymood_separator_color"]);
update_option('mymood_separator_show',$_POST["mymood_separator_show"]);
update_option('mymood_smiley_show',$_POST['mymood_smiley_show']);
update_option('mymood_status_show',$_POST['mymood_status_show']);
_e('<div id="message" class="updated fade">
  <p>
    <strong>Status saved.</strong>
  </p>
</div>');
} 


$mymooddir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

?>

<div class="postbox-container" style="width:70%">

<!-- JS COLOR SCRIPT -->
<script type="text/javascript" src="<?php echo $mymooddir; ?>/jscolor/jscolor.js"></script>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class="form-table">

<tr valign="top">
<th scope="row"><?php _e("Smiley") ?> : <br />
 <span class="description">Select Smile for showing your expression ;).</span>
</th>

    <td  style="height:48px;  background-image:url(<?php echo $mymooddir; ?>/select.gif); background-repeat:no-repeat"><img style="margin-left:6px; margin-top:-2px" src="<?php echo $mymooddir; ?>/smileys/<?php echo get_option('mymood_smiley'); ?>" width="35" height="35" alt="smiley" id="mymood_smileyimg" onclick="smiley_mymoodopen()" /> 
   
    <div id="mymood_smileys" style="display:none">  
      <div style="position:absolute; z-index:110; margin-top:-15px; background-color:#E6E6E6"><strong><a href="javascript:smiley_mymoodopen();" onclick="smiley_mymoodopen();">X</a></strong></div>
  <div style="position:absolute; margin-top:-10px; z-index:4; border-style:solid; border-width:2px; border-color:#FC0; background-color:#FFC; overflow:scroll; height:150px;  width:400px"> 
<?php 
for($i = 1; $i <= 98; $i++) {
_e(' <img src="'.$mymooddir.'/smileys/'.$i.'.gif" alt="Loading..." onclick="smiley_mymood(this)" />
   ');
}
?>
   </div>  
   
   
    </div>
    
    <script type="text/javascript">
        function smiley_mymoodopen() {
        var mood = document.getElementById("mymood_smileys");
                if(mood.style.display == '') {        
mood.style.display = 'none';                
                } else {
mood.style.display = '';                                
                }
        mood.onblur = function () {
        mood.style.display = 'none';        
        }
        }
    function smiley_mymood(id) {

        image = id.src;
   image = image.split("/");
   for(i=0; i < image.length; i++) {
        tmp = image[i];   
   }
 var image = tmp;
 document.getElementById("mymood_smiley").value = tmp;
document.getElementById("mymood_smileyimg").src = id.src;

          }
      </script>
	 <br /> <br /><label for="mymood_smiley_show">Show Smiley  :
<select name="mymood_smiley_show">
<option value="1" <?php echo (get_option("mymood_smiley_show") != "0")?'selected="selected"':''; ?>>Yes</option>
<option value="0" <?php echo (get_option("mymood_smiley_show") == "0")?'selected="selected"':''; ?>>No</option>
</select></label>
      <input  name="mymood_smiley" id="mymood_smiley" value="<?php echo get_option('mymood_smiley'); ?>" type="hidden" />
    </td>
  </tr>
  
  
  <tr valign="top">
<th scope="row"><?php _e("Status") ?> :<br />
<span class="description">Write about your mood or you can select mood from mood list by clicking "Select one" above.</span>
</th>
  
      <td> <label for="mymood_status"> Your Status </label> : <input class="regular-text" onfocus="status_mymoodopen();" value="<?php echo get_option('mymood_status'); ?>" type="text" name="mymood_status" id="mymood_status" /> 
      <a href="javascript:;" onclick="status_mymoodopen();">Select one</a> 
      <script type="text/javascript">
        function status_mymoodopen() {
        var mood = document.getElementById("mymood_statusdiv");
                if(mood.style.display == '') {        
mood.style.display = 'none';                
                } else {
mood.style.display = '';                                
                }
        mood.onblur = function () {
        mood.style.display = 'none';        
        }
        }
      function status_mymood(id) {
        document.getElementById("mymood_status").value = id.innerHTML;        status_mymoodopen();
          }
      </script>
      <div style="display:none" id="mymood_statusdiv"> 
      <div style="position:absolute; z-index:110; margin-top:-15px; background-color:#E6E6E6"><strong><a href="javascript:;" onclick="status_mymoodopen()">X</a></strong></div>
      <div style="overflow:scroll; position:absolute;  z-index:111; z-index:2px; height:150px; background-color:white; border-color:gray; border-width:1px; border-style:solid;">
      <table border="0">
          <?php
          foreach($mymood_moods as $mymood_moods) {
         echo ' <tr>
    <td onclick="status_mymood(this)" style="background-color:#FFC; border-style:solid; border-width:1px; border-color:#CCC;">'.$mymood_moods.'</td>
  </tr>'; 
          
          
          }
          ?>
</table></div></div><br />
<label for="mymood_separator_show">Show Status  :
<select name="mymood_status_show">
<option value="1" <?php echo (get_option("mymood_status_show") != "0")?'selected="selected"':''; ?>>Yes</option>
<option value="0" <?php echo (get_option("mymood_status_show") == "0")?'selected="selected"':''; ?>>No</option>
</select></label>

</td>
  </tr>
  
  <tr valign="top">
<th scope="row"><?php _e("Description") ?> :<br />
<span class="description"> Write Description about your mood :). </span>
</th>
    <td>
	<script type="text/javascript" src="<?php echo $mymooddir; ?>/nicEdit.js"></script> 
	<textarea  cols="70" rows="10" name="mymood_else" id="mymood_else"  class="codepress css"><?php echo get_option('mymood_else'); ?></textarea>
	
	<script type="text/javascript">
	bkLib.onDomLoaded(function() { 
	  new nicEditor({ 	buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','indent','outdent','link','unlink','forecolor','bgcolor'],iconsPath : '<?php echo $mymooddir; ?>/nicEditorIcons.gif'}).panelInstance('mymood_else');
});
	</script></td>
  </tr>

  <!-- Saparater  TEXT -->
  <tr>
  <th scope="row"><?php _e("Separator") ?> : <br />
 <span class="description">Separator Setting.</span>
</th>
<td>
<label for="mymood_separator_color">Color :</label> 
<input class="color regular-text" value="<?php echo get_option('mymood_separator_color'); ?>" type="text" name="mymood_separator_color"/> 
<br/>
<label for="mymood_separator_show">Show Separator  :
<select name="mymood_separator_show">
<option value="1" <?php echo (get_option("mymood_separator_show") != "0")?'selected="selected"':''; ?>>Yes</option>
<option value="0" <?php echo (get_option("mymood_separator_show") == "0")?'selected="selected"':''; ?>>No</option>
</select></label>
</td>  
  </tr>
  <!-- MOOD TEXT -->
  <th scope="row"><?php _e("Mood Text") ?> : <br />
 <span class="description">Mood text to be shown to visitor.<br /> Eg : Mood, Status, Feeling.</span>
</th>
<td>
<input class="regular-text" value="<?php echo get_option('mymood_mood_text'); ?>" type="text" name="mymood_mood_text"/> 
</td>

  
  <tr>
    <td height="26">&nbsp;</td>
    <td>
      <input type="submit" name="Update" class="button-primary" value="Update" />
    </td>
  </tr>
</table></form></div></div>


<!-- NEWS -->

<?php 
if(get_option("tabgarb_news") == "") {
$tabgarb_news = wp_remote_fopen("http://webgarb.com/fetch_news/mymood_news.php?ver=1.2");
update_option("mymood_news",$tabgarb_news);
update_option("mymood_news_date",date("Y-m-d",strtotime("+2 day")));
}
$extime = strtotime(get_option("tabgarb_news_date"));
$nowtime = strtotime(date("Y-m-d"));
if($nowtime > $extime) {
$tabgarb_news = wp_remote_fopen("http://webgarb.com/fetch_news/mymood_news.php?ver=1.2");
update_option("mymood_news",$tabgarb_news);
update_option("mymood_news_date",date("Y-m-d",strtotime("+2 day")));
}

?>
<div class="postbox-container" style="width:28%">

 <center>
 <a href="http://webgarb.com/?s=Mymood" target="_blank" title="Vi
 sit tabGarb Home Page"><img src="<?php echo $mymooddir."/logo.png"; ?>" border="0">
 </a> 
 </center>
 
<?php 
echo get_option("mymood_news"); 
?>
</div>
<div class="clear"></div>

<!-- NEW END -->



<h3>Need Help ? Visit <a href="http://webgarb.com/?s=Mymood">Mymood</a> Home Page <a href="http://webgarb.com/?s=Mymood">http://webgarb.com/?s=Mymood</a></h3>

<span class="description"><a href="http://webgarb.com/?s=Mymood">Mymood</a> &copy; Copyright 2009 - 2010 Webgarb.com . MyMood Contain Graphic Smiley are property of their respective owner.<br />
</span>


<h2>PHP Code for adding into Templete.</h2>
You can add MyMood Widget for displaying it into your sidebar else for displaying Mymood in custom area use this code below.
<br />
<!--PHP CODE-->
<div class="php" style="font-family:monospace;color: #006; border: 1px solid #d0d0d0; background-color: #f0f0f0;"><ol><li style="font-weight: normal; vertical-align:top;font: normal normal 130% 'Courier New', Courier, monospace; color: #003030;"><div style="font: normal normal 1em/1.2em monospace; margin:0; padding:0; background:none; vertical-align:top;;white-space: nowrapcolor: #000020;"><span style="color: #000000; font-weight: bold;">&lt;?php</span> </div></li>
<li style="font-weight: normal; vertical-align:top;font: normal normal 130% 'Courier New', Courier, monospace; color: #003030;"><div style="font: normal normal 1em/1.2em monospace; margin:0; padding:0; background:none; vertical-align:top;;white-space: nowrapcolor: #000020;">&nbsp;</div></li>
<li style="font-weight: normal; vertical-align:top;font: normal normal 130% 'Courier New', Courier, monospace; color: #003030;"><div style="font: normal normal 1em/1.2em monospace; margin:0; padding:0; background:none; vertical-align:top;;white-space: nowrapcolor: #000020;">&nbsp;mymood_display<span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span></div></li>
<li style="font-weight: normal; vertical-align:top;font: normal normal 130% 'Courier New', Courier, monospace; color: #003030;"><div style="font: normal normal 1em/1.2em monospace; margin:0; padding:0; background:none; vertical-align:top;;white-space: nowrapcolor: #000020;">&nbsp;</div></li>
<li style="font-weight: normal; vertical-align:top;font: normal normal 130% 'Courier New', Courier, monospace; color: #003030;"><div style="font: normal normal 1em/1.2em monospace; margin:0; padding:0; background:none; vertical-align:top;;white-space: nowrapcolor: #000020;"><span style="color: #000000; font-weight: bold;">?&gt;</span></div></li>
</ol></div>
<!--END PHP CODE-->

<?php


}
//ADMIN PANEL FUNCTION END !
//Manual 
function mymood_display() {
$mymooddir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
echo '
<!-- MyMood Plugin 1.2 -->
  '.((get_option("mymood_smiley_show") =='0')?'':'<img src="'.$mymooddir.'/smileys/'.get_option("mymood_smiley").'" border="0" style="float:left;margin:2px; margin-right:4px;">').'

  '.((get_option("mymood_status_show") == '0')?'':'<b>'.__(get_option("mymood_mood_text")).'</b> '.__(get_option("mymood_status")).'').'  <br />
   
   '.((get_option("mymood_separator_show") == '0')?'<div style="display:block"></div>':'<div style="border-width:1px;border-color:#'.get_option("mymood_separator_color").';border-style:solid;width:100%; margin-top:3px; margin-bottom:3px"></div>').' 
   
	<div>'.stripslashes(get_option("mymood_else")).'</div><div style="clear:left;"></div>';
} 
 
 
//Widget
function mymood_widget($args) {
extract($args);

$mymooddir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

$title = get_option("mymood_widget_title");

echo $before_widget; 
echo $before_title.$title. $after_title; 
mymood_display();
echo $after_widget;
}

//WIDGET CONTROL 

function mymood_control() {
if(isset($_POST["mymood_widget_title"])) {
update_option("mymood_widget_title",$_POST["mymood_widget_title"]);
}
echo '<p><label for="mymood_widget_title">Title :</label><input class="widefat" name="mymood_widget_title" value="'.get_option("mymood_widget_title").'"  type="text"></p>';
}
function mymood_widget_installer() {
register_sidebar_widget(_('MyMood Widget'),'mymood_widget');
  register_widget_control("MyMood Widget",'mymood_control',0 , 0 );
}
add_action("plugins_loaded", "mymood_widget_installer");
?>