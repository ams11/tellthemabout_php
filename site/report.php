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
define ('TITLE', 'Report an Issue');
require("header.html");
require_once("DBConnect.php");
require_once("BloggerData.php");
?>

<div class="mainWidths">

<?php require("menu.php"); ?>		<!-- top level navigation menu -->

	<div style="padding-left:25px; background-position:top right;height:680px; font-size:11pt" class="mainBackground">
		<div style="width:75%; padding-top:20px">
<form action="addbug.php" method="post">
	Reported By: <input name="name"></input><br />
	Description:<br /> <textarea name="descr" style="width:400px;height:300px"></textarea><br />
	Please provide as much of a description as you can as to what is going on, and how you arrived at the current state.<br />
	Also, please include browser information.<br />If the issue you are seeing is a display problem, it would help
	me a lot, if you could include a screenshot. To take a screenshot (on Windows):<br/>
	<ul>
	<li>hit Ctrl + Prt Sc (Prt Sc is usually somewhere near the top right corner of your keyboard</li>
	<li>Launch MS Paint - go to Programs | Accessories | Paint</li>
	<li>hit Ctrl + V to paste, your screenshot should now be pasted into Paint</li>
	<li>Save the image to some location on your harddrive</li>
	<li>send me an email at alex_slepak_99@hotmail.com with the file you just saved attached - I'll see how much I can figure out from there!</li>
	</ul>
	Thanks for your help!<br />
	<br /><input type="submit" value="Send Report" />
</form>
		</div>
	</div>
</div>

<script type="text/javascript">
cssdropdown.startchrome("mainmenu")
</script>



<?php
require("footer.html");
?>