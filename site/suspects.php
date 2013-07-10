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
define ('TITLE', 'The Usual Suspects');
require("header.html");
require_once("DBConnect.php");
require_once("BloggerData.php");
?>

<div class="mainWidths">

<?php require("menu.php"); ?>		<!-- top level navigation menu -->

	<div style="padding-left:25px; background-position:top right;height:580px; font-size:11pt" class="mainBackground">
		<div style="width:60%; padding-top:20px">
		<img src="/img/sfty3rd.jpg" title="Oops! - Safety Third!" /><br /><br />
		A little more work to be done here too...
		</div>
	</div>
</div>

<script type="text/javascript">
cssdropdown.startchrome("mainmenu")
</script>



<?php
require("footer.html");
?>