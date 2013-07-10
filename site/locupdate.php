<?php

require("DBConnect.php");
require_once("defines.php");

$dbCon = new DBConnect();
$dbCon->Connect();

foreach ($_POST['locs'] as $loc)
{
    $query = "UPDATE rr2008_msgs r SET lat=" . $loc["lat"] . ",lng=" . $loc["lng"] . ",ptIndex=" . $loc["pti"] . " WHERE id=" . $loc["id"];
    echo $query;
    $dbCon->RunQuery($query);
}

echo " - Success";
?>
