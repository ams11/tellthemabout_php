<?php
define ('TITLE', 'Twitter test');
require("header.html");
require("DBConnect.php");
?>

<body>
    <div id="twit"></div>
<script type="text/javascript">
    try
    {
<?php
// http://twitter.com/statuses/user_timeline/cyrusgray.json
define ("HOSTNAME", "http://twitter.com/statuses/user_timeline/");

$id = $_GET["id"];
$url = HOSTNAME . $id . ".json";

// Open the Curl session
$session = curl_init($url);

// Return the call not the headers
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// call the data
$data = curl_exec($session);
echo "var rgMsgs = " . $data . ";";
curl_close($session);
?>
        var divTwitter = document.getElementById("twit");
        for (var i=0; i<rgMsgs.length; i++)
        {
            divTwitter.innerHTML += "on " + rgMsgs[i].created_at + ", " + rgMsgs[i].user.name + " said:<br />" + rgMsgs[i].text + "<br /><br />";
        }
    }
    catch (e)
    {
        alert(e.message);
    }
</script>
<?php
$dbCon = new DBConnect();
$dbCon->Connect();

date_default_timezone_set('America/Los_Angeles');

$array = json_decode($data, true);
foreach ($array as $tweet)
{
    $dt = date_parse($tweet["created_at"]);
    $create_dt = mktime($dt["hour"], $dt["minute"], $dt["second"], $dt["month"], $dt["day"], $dt["year"]);
    $query = "INSERT INTO twitter (id, date, user, msg, userid) VALUES(" .
        $tweet["id"] . ",\"" .
        date ('Y-m-d H:i:s', $create_dt) . "\",\"" .
        $tweet["user"]["name"] . "\",\"" .
        $tweet["text"] . "\"," .
        $tweet["user"]["id"] . ");";

    $dbCon->RunQuery($query);
}
?>

</body>