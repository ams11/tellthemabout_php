<?php
echo "in locadd.php<br />";
require("DBConnect.php");
require_once("defines.php");
require_once("post.php");

$dbCon = new DBConnect();
$dbCon->Connect();

date_default_timezone_set("GMT");

foreach ($_POST['locs'] as $loc)
{
	echo $loc["loc"] . "<br />";
    $strdate = date('Y-m-d H:i:s', $loc["dt"]);
    $query = "INSERT INTO rr2008_msgs (date,loc,text,lat,lng,type," . 
             (($loc["pti"] == "-1") ? "" : "ptIndex,") . "siteid) VALUES(" .
             "\"" . $strdate . "\",\"" . $loc["loc"] . "\",\"" . $loc["txt"] . "\"," . $loc["lat"] . "," .
             $loc["lng"] . "," . LOC . "," .
             (($loc["pti"] == "-1") ? "" : $loc["pti"] . ",") . $loc["sid"] . ");";
	echo $query;
    $dbCon->RunQuery($query);
}

echo " - Success";
?>
