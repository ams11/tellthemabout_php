<?php
define ('TITLE', 'Location Codes');
define ('TEMPLATE', 'blank');
require("header.html");
require_once("DBConnect.php");

$dbCon = new DBConnect();
$result = $dbCon->RunQuery("SELECT * from loccodes");

while ($row = mysql_fetch_object($result))
{
    echo $row->name . ": " . $row->abbr . " at (" . $row->lat . ", " . $row->lng . ")<br />";
}

echo "<br />Add 's' for straight line, to override directions-supporting region detection";

?>

<?php
require("footer.html");
?>