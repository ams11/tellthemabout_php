<?php

require("DBConnect.php");

$dbCon = new DBConnect();
$dbCon->Connect();

// just insert a new row
$query = "INSERT INTO points (pts, siteid) VALUES(\"" . $_POST['pts'] . "\", " . $_POST['siteid'] . ");";
echo $query;
$dbCon->RunQuery($query);

echo "Success";
?>