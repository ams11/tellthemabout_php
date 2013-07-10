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
define ('TITLE', 'Photo Albums');
require("header.html");
require_once("DBConnect.php");
require_once("BloggerData.php");
?>

<div class="mainWidths">

<?php require("menu.php"); ?>		<!-- top level navigation menu -->

	<div style="padding-left:25px; background-position:top right;" class="mainBackground">

<?php
	$extData = new ExternalData(3);
	$extData->GetPhotoAlbums();
?>

	</div>
</div>

<script type="text/javascript">
cssdropdown.startchrome("mainmenu")
</script>



<?php
require("footer.html");
?>