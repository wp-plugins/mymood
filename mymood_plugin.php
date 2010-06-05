<?php /*
Plugin Name: MyMood
Plugin URI:  http://webgarb.com/?s=Mymood
Description: Mymood Plugin usging this plugin you can show of your status or mood to your visitor simpily putting a widget in your sidebar Mymood comes with 97 cool difference Smileys and with many Unique Mood List . 
Version: 1.1
Author: Webgarb
Author URI: http://Webgarb.com
*/

register_activation_hook(__FILE__, 'mymood_activ');
add_action('admin_menu', 'mymood_adminoption');

function mymood_activ() {
add_option("mymood_smiley","11.gif");
add_option("mymood_status","Happy");
add_option("mymood_else","I have just Install MyMood Plugin !");
return true;
}
function mymood_adminoption() {
  
  add_options_page('MyMood Plugin option area','MyMood', 8,__FILE__, 'mymood_adminpanel');

  }
  
  
  
  
function mymood_adminpanel() {  ?>
<div class="wrap">
<h2> My Mood 1.1</h2>
<?php
 
$mymood_moods = array('None', 'Afraid', 'Amazed', 'Angry', 'Annoyed', 'Anxious', 'Aroused', 'Ashamed', 'Accomplished', 'Aggravated', 'Alone', 'Amused', 'Apathetic', 'Awake', 'Accepted', 'Bored', 'Brave', 'Bewildered', 'Bitchy', 'Bittersweet', 'Blah', 'Blank', 'Blissful', 'Bouncy', 'Calm', 'Cold', 'Confused', 'Contented', 'Curious', 'Cheerful', 'Chipper', 'Complacent', 'Content', 'Cranky', 'Crappy', 'Crazy', 'Crushed', 'Cynical', 'Depressed', 'Disappointed', 'Disgusted', 'Distracted', 'Dark', 'Determined', 'Devious', 'Dirty', 'Discontent', 'Ditzy', 'Dorky', 'Drained', 'Drunk', 'Embarrassed', 'Excited', 'Ecstatic', 'Energetic', 'Enraged', 'Enthralled', 'Envious', 'Exanimate', 'Exhausted', 'Flirtations', 'Frustrated', 'Flirty', 'Full', 'Grumpy', 'Guilty', 'Geeky', 'Giddy', 'Giggly', 'Gloomy', 'Good', 'Grateful', 'Groggy', 'Grumpy', 'Guilty', 'Happy', 'Hot', 'Humbled', 'Humiliated', 'Hungry', 'Hurt', 'High', 'Hopeful', 'Hyper', 'Impressed', 'In awe', 'In love', 'Indignant', 'Interested', 'Intoxicated', 'Invincible', 'Indescribable', 'Indifferent', 'Infuriated', 'Irate',  'Jealous', 'Jubilant', 'Lonely', 'Lazy', 'Lethargic', 'Listless', 'Loved', 'Mean', 'Moody', 'Mad', 'Melancholy', 'Mellow', 'Mischievous', 'Moody', 'Morose', 'Nervous', 'Neutral', 'Naughty', 'Nerdy', 'Not Specified', 'Numb', 'Offended', 'Optimistic', 'Playful', 'Proud', 'Peaceful', 'Pessimistic', 'Pissed off', 'Pleased', 'Predatory', 'Quixotic', 'Relieved', 'Remorseful', 'Restless', 'Recumbent', 'Refreshed', 'Rejected', 'Rejuvenated', 'Relaxed', 'Relieved', 'Rushed', 'Sad', 'Sarcastic', 'Serious', 'Shocked', 'Shy', 'Sick', 'Sleepy', 'Stressed', 'Surprised', 'Satisfied', 'Silly', 'Smart', 'Thristy', 'Thankful', 'Tired', 'Touched', 'Uncomfortable', 'Weird', 'Worried');
//This Mood taken From CurrentStatus Thanks :)
if($_POST[Update] == true) {
update_option('mymood_smiley', $_POST['mymood_smiley']);
update_option('mymood_status', $_POST['mymood_status']);
update_option('mymood_else', $_POST['mymood_else']);
_e('<div id="message" class="updated fade">
  <p>
    <strong>Status saved.</strong>
  </p>
</div>');
} 


$mymooddir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

?>



<p><img src="<?php echo $mymooddir; ?>/logo.png" width="234" height="88" alt="logo" /></p>
<form target="_self" method="post">
<table border="0">
  <tr>
    <td><label for="mymood_smiley">Smiley : </label></td>
    <td onclick="smiley_mymoodopen()" style="height:48px;  background-image:url(<?php echo $mymooddir; ?>/select.gif); background-repeat:no-repeat"><img style="margin-left:6px;" src="<?php echo $mymooddir; ?>/smileys/<?php echo get_option('mymood_smiley'); ?>" width="40" height="34" alt="smiley" id="mymood_smileyimg"  /> 
    <span class="description"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Select Smile for showing ur expression ;).</span>
    <div id="mymood_smileys" style="display:none">  
      <div style="position:absolute; z-index:5; margin-top:-15px; background-color:#E6E6E6"><strong><a href="javascript:smiley_mymoodopen();" onclick="smiley_mymoodopen();">X</a></strong></div>
  <div style="position:absolute; margin-top:-10px; z-index:4; border-style:solid; border-width:2px; border-color:#FC0; background-color:#FFC; overflow:scroll; height:150px;"> 
<?php 
for($i = 1; $i <= 98; $i++) {
_e(' <img src="'.$mymooddir.'/smileys/'.$i.'.gif" alt="Loading..." onclick="smiley_mymood(this)" />
    <hr>');
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
      <input  name="mymood_smiley" id="mymood_smiley" value="<?php echo get_option('mymood_smiley'); ?>" type="hidden" />
    </td>
  </tr>
  <tr>
    <td><label for="mymood_status">Status :</label></td>
    <td><input class="regular-text" onfocus="status_mymoodopen();" value="<?php echo get_option('mymood_status'); ?>" type="text" name="mymood_status" id="mymood_status" /> 
      <a href="javascript:;" onclick="status_mymoodopen();">Select one</a> <span class="description">Write about your mood or you can select mood from mood list by clicking "Select one" above.</span>
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
      <div style="position:absolute; z-index:5; margin-top:-15px; background-color:#E6E6E6"><strong><a href="javascript:;" onclick="status_mymoodopen()">X</a></strong></div>
      <div style="overflow:scroll; position:absolute; z-index:2px; height:150px;background-color:white; border-color:gray; border-width:1px; border-style:solid;">
      <table border="0">
          <?php
          foreach($mymood_moods as $mymood_moods) {
         echo ' <tr>
    <td onclick="status_mymood(this)" style="background-color:#FFC; border-style:solid; border-width:1px; border-color:#CCC;">'.$mymood_moods.'</td>
  </tr>'; 
          
          
          }
          ?>
</table></div>

      </div></td>
  </tr>
  <tr>
    <td><label for="mymood_else">Description : </label></td>
    <td><textarea name="mymood_else" cols="40" rows="4"><?php echo get_option('mymood_else'); ?></textarea><span class="description"> Write Description about your mood :). </span></td>
  </tr>
  <tr>
    <td height="26">&nbsp;</td>
    <td>
      <input type="submit" name="Update" class="button-primary" value="Update" />
    </td>
  </tr>
</table></form>

<h3>Need Help ? Visit <a href="http://webgarb.com/?s=Mymood">Mymood</a> Home Page <a href="http://webgarb.com/?s=Mymood">http://webgarb.com/?s=Mymood</a></h3>

<span class="description"><a href="http://webgarb.com/?s=Mymood">Mymood</a> &copy; Copyright 2009 - 2010 Webgarb.com . Smiley are Property is of there respective owner.<br />
<span>
</div>
<?php


}
//ADMIN PANEL FUNCTION END !
//Manual 
function mymood_display() {
$mymooddir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
echo '
  <img src="'.$mymooddir.'/smileys/'.get_option("mymood_smiley").'" border="0" style="float:left;margin:2px; margin-right:4px;">

   <b>Mood :</b> '.get_option("mymood_status").' <br /> <center><div style="border-width:1px;border-color:#E6E6E6;border-style:solid;width:100%; margin-top:5px; margin-bottom:5px"></div></center>  <div>'.stripslashes(get_option("mymood_else")).'</div><div style="clear:left;"></div>';
} 
 
 
//Widget
function mymood_widget($args) {
extract($args);

$mymooddir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));



echo $before_widget; 
echo $before_title.'My Mood Status'. $after_title; 
echo '
  <img src="'.$mymooddir.'/smileys/'.get_option("mymood_smiley").'" border="0" style="float:left;margin:2px; margin-right:4px;">

   <b>Mood :</b> '.get_option("mymood_status").' <br /> <center><div style="border-width:1px;border-color:#E6E6E6;border-style:solid;width:100%; margin-top:5px; margin-bottom:5px"></div></center>  <div>'.stripslashes(get_option("mymood_else")).'</div><div style="clear:left;"></div>';
echo $after_widget;
}
function mymood_widget_installer() {
register_sidebar_widget('MyMood Widget','mymood_widget');
}
add_action("plugins_loaded", "mymood_widget_installer");
?>