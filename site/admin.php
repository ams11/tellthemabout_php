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
define ('TITLE', 'Administrator Console');
require("header.html");
require_once("DBConnect.php");
require_once("BloggerData.php");
?>

<div class="mainWidths">

<?php require("menu.php"); ?>		<!-- top level navigation menu -->

	<div style="padding-left:25px; background-position:top right;height:580px; font-size:11pt" class="mainBackground">
		<div style="width:60%; padding-top:20px">
		<img src="/img/sfty3rd.jpg" title="Oops! - Safety Third!" /><br /><br />
		Admin a Console: sadly, too big of a work item to achieve a particularly high priority at the moment. But, I do have all sorts of good ideas here...
		</div>
	</div>
</div>

<script type="text/javascript">
cssdropdown.startchrome("mainmenu")
</script>



<?php
require("footer.html");
?>