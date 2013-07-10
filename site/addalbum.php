<?php
require_once("DBConnect.php");

date_default_timezone_set('GMT');

$dbCon = new DBConnect();
$idquery = "select id from rr2008_msgs order by id desc limit 1;";
$result = $dbCon->RunQuery($idquery);
$row = mysql_fetch_object($result);
$id = $row->id + 1;

// BUGBUG - the id is a potential concurrency issue - bug id: 21

$strdate = date('Y-m-d H:i:s', strtotime($_POST["date"]));
$query = "INSERT INTO rr2008_msgs (id, date,text,title,url,type,author,tags, siteid, icon, description) VALUES(" . 
		 $id . "," .
		 "\"" . $strdate . "\"," .
		 "\" \"," .
		 "\"" . $_POST["title"] . "\"," .
		 "\"" . $_POST["url"] . "\"," .
		 "2," .
		 "\"Alex\"," .
		 "\"" . $_POST["tags"] . "\"," .
		 $_POST["siteid"] . "," .
		 "\"" . $_POST["icon"] . "\"," .
		 "\"" . $_POST["description"] . "\"" .
		 ");";
echo $query . "<br />";

$dbCon->RunQuery($query);

$query2 = "INSERT INTO photos (id, count, imgurl1, imgurl2, imgurl3, url1, url2, url3) VALUES(" .
		  $id . "," .
		  $_POST["num"] . "," .
		  "\"" . $_POST["imgurl1"] . "\"," .
		  "\"" . $_POST["imgurl2"] . "\"," .
		  "\"" . $_POST["imgurl3"] . "\"," .
		  "\"" . $_POST["url1"] . "\"," .
		  "\"" . $_POST["url2"] . "\"," .
		  "\"" . $_POST["url3"] . "\");";

echo $query2;
$dbCon->RunQuery($query2);

?>