<?php
if ( !defined( 'ABSPATH' ) ) exit;

function captcha_garb_install() {
	$style_css = '.captchagarb {
background-color:#005F89;
margin-top:5px;
margin-bottom:5px;
width:160px;
-webkit-border-radius:5px;
border-radius:5px;
border-color:#004C6D;
border-style:solid;
border-width:1px;
}

.captchagarb .loader {
display:none;
margin:5px auto;
}

.captchagarb .puzit {
display:block;
background-color:#004C6D;
text-align:center;
color:#49B1DF;
text-transform:uppercase;
}

.captchagarb .refr {
width:58px;
height:20px;
line-height:20px;
display:block;
background-color:#0084BE;
text-decoration:none;
text-align:center;
font-size:10px;
text-transform:uppercase;
color:#003851;
-webkit-border-radius:2px;
border-radius:2px;
margin:auto auto 4px;
}

.captchagarb .refr:hover {
background-color:#09D;
}

.captchagarb .puz_container {
margin:0;
padding:0;
}

.captchagarb .puz_container ul {
width:154px;
margin:5px auto;
padding:0;
}

.captchagarb .puz_container ul li {
cursor:move;
border-color:#004462;
border-style:outset;
border-width:1px;
padding:0;
}';
	
	update_option("cgarb_enable","yes");
	update_option("cgarb_css",$style_css);
	

	update_option("captcha_garb_install","1"); 

}

if(get_option("captcha_garb_install") != "1") {
	captcha_garb_install();
}

?>