<?php

require("DBConnect.php");
require_once("defines.php");

$dbCon = new DBConnect();
$dbCon->Connect();

$params = "";
foreach ($_POST as $name  => $value)
{
    if ($name == "siteid")
    {
        continue;
    }
    $params = $params . (($params == "") ? "" : ",") . $name . "=" . $value;
}

$query = "UPDATE master SET " . $params . " WHERE siteid=" . $_POST["siteid"];        // hooray for security...
echo $query;
$dbCon->RunQuery($query);

echo " - Success";
?>