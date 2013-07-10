<?php
require_once("defines.php");
if (defined('SITEID'))
{
	$siteid = SITEID;
}
else if (array_key_exists("siteid", $_GET))
{
	$siteid = $_GET["siteid"];
}
else
{
	$siteid = DEFAULT_SITEID;
}
define ('TITLE', 'Get in Touch');
require("header.html");
require_once("DBConnect.php");
require_once("BloggerData.php");
?>

<div class="mainWidths">

<?php require("menu.php"); ?>		<!-- top level navigation menu -->

	<div style="padding-left:25px; background-position:top right;height:580px; font-weight:bold; font-size:12pt" class="mainBackground">
		<br />
		<form method="post" action="verify.php">
			Your Name: <br />
			<input type="text" style="margin-top:5px" size="45"/><br /><br />
			Your Email Address: <br />
			<input type="text" style="margin-top:5px" size="45"/><br /><br />
			Message:<br />
			<textarea rows="7" cols="60" style="margin-top:5px">Your message here</textarea><br /><br />

<?php
require_once('ext/recaptchalib.php');
$publickey = "6LcJbL8SAAAAAGGVAIB7qadNaMm5tFPTj5ukAVnE"; // you got this from the signup page
echo recaptcha_get_html($publickey);
?>

		<br />
		<input type="submit" value="Send" disabled="true"/><br />
		</form>
		<font size="-1">(We're working on it...)</font>
	</div>
</div>

<script type="text/javascript">
cssdropdown.startchrome("mainmenu")
</script>



<?php
require("footer.html");
?>