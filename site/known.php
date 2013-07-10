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
define ('TITLE', 'Known Issues');
require("header.html");
require_once("DBConnect.php");
require_once("BloggerData.php");
?>

<div class="mainWidths">

<?php require("menu.php"); ?>		<!-- top level navigation menu -->

	<div style="padding-left:25px; background-position:top right;height:680px; font-size:11pt" class="mainBackground">
		<div style="width:75%; padding-top:20px">
<table border="1" cellspacing="0" cellpadding="2">
	<tr>
		<td width="50px" valign='top' align='center'><b>id</b></td>
		<td width="75px" valign='top' align='center'><b>Reported By</b></td>
		<td width="75px" valign='top' align='center'><b>Date</b></td>
		<td width="300px" valign='top' align='center'><b>Description</b></td>
		<td width="300px" valign='top' align='center'><b>Comment</b></td>
	</tr>
<?php
$dbCon = new DBConnect();
$result = $dbCon->RunQuery("SELECT * from bugs where type=1");

while ($row = mysql_fetch_object($result))
{
	echo "<tr>\n";
	echo "<td valign='top' align='center'>" . $row->id . "</td>\n";
	echo "<td valign='top' align='center'>" . $row->reported . "</td>\n";
	$dt = strtotime($row->date);
	echo "<td valign='top' align='center'>" . date('Y-m-d', $dt) . "</td>\n";
	echo "<td valign='top'>" . $row->description . "</td>\n";
	echo "<td valign='top'>" . $row->comment . "</td>\n";
	echo "</tr>\n";
}


?>	
</table>
		</div>
	</div>
</div>

<script type="text/javascript">
cssdropdown.startchrome("mainmenu")
</script>



<?php
require("footer.html");
?>