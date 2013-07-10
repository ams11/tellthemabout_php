<?php
require("DBConnect.php");

date_default_timezone_set('GMT');

echo $_POST["name"] . "<br />" . $_POST["descr"] . "<br />";

$dbCon = new DBConnect();
$strdate = date('Y-m-d H:i:s', time());
$query = "INSERT INTO bugs (date, description, reported, type) VALUES(" .
		 "\"" . $strdate . "\"," .
		 "\"" . $_POST["descr"] . "\"," .
		 "\"" . $_POST["name"] . "\"," .
		 "0);";
echo $query . "<br />";

$dbCon->RunQuery($query);
?>