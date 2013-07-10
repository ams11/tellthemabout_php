<?php

require("DBConnect.php");
require_once("defines.php");

$dbCon = new DBConnect();
$dbCon->Connect();

// regenerate the whole table with what's given here
$query = "DELETE FROM points WHERE id>0 AND siteid=" . $_POST['siteid'];
$dbCon->RunQuery($query);

$query = "INSERT INTO points (pts, siteid) VALUES(\"" . $_POST['pts'] . "\", " . $_POST['siteid'] . ");";
//echo $query;
$dbCon->RunQuery($query);

echo "Success";
?>