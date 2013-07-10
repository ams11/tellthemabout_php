<?php
define ('TITLE', 'Google Maps Directions test');
require("header.html");
require_once("DBConnect.php");
require_once("BloggerData.php");
require_once("defines.php");
?>

<body onunload="GUnload()">
<script type="text/javascript">
    try
    {
        var rgPts = null;
<?php
    if (defined('DEBUG'))
    {
            $debug = 1;
    }
    else if (array_key_exists("debug", $_GET))
    {
        $debug = $_GET["debug"];
    }
    else
    {
        $debug = 0;
    }
    $errdisp = "none";
    if ($debug == 1)
    {
            $errdisp = "";
    }
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
        $siteid = 2;
    }

    if ($siteid == null)
    {
        echo "} catch (e) {} </script>";
        echo "<h3>Please specify the site id</h3>";
        die;
    }
    echo "rgPts = [";
    $dbCon = new DBConnect();
    $result = $dbCon->RunQuery('SELECT * FROM points where siteid = ' . $siteid);
    while ($row = mysql_fetch_object($result))
    {
        echo preg_replace("/X/", "new GLatLng", $row->pts);
    }
    echo "];\n";
?>
    }
    catch (e)
    {
        alert(e.message);
    }
</script>

    <table width="100%" border="0">
        <tr valign="top">
            <td>
                <div id="map" style="width: 550px; height: 450px"></div>
            </td>
            <td align="left" style="display:">
				<div style="padding:5px">
					<b>Tools</b><br />
					<a href="http://twitter.com/aslepak" target="blog">Raw twitter feed</a> (verify location updates)<br />
					<a href="http://safety3rd.blogspot.com" target="blog">Blog home</a> (verify blog updates)<br />
					<a href="known.php" target="blog">Known Issues</a><br />
					<a href="report.php" target="blog">Report an issue</a><br />
				</div>
                <div style="border-width:thick;overflow:auto;max-height:350px;display:<?php echo $errdisp; ?>" id="err"></div>
            </td>
        </tr>
    </table>
    <a href="javascript:myzoom(1)">Zoom +1</a><br />
    <a href="javascript:myzoom(-1)">Zoom -1</a><br />
    <br />
<?php
    $extData = new ExternalData($siteid);

    $dtToday = ($siteid == 1) ? "2008-01-26" : date('Y-m-d', strtotime(date('Y-m-d', time()) . "+1 day"));;
    $nNew = $extData->GetNewPosts($dtToday);
//    $nNew = 0;
    $extData->GetCachedPosts();
    $extData->FinalizeOutput();
    if ($nNew > 0)
    {
        $extData->UpdateCache();
    }
    $center = $extData->GetCachedCenter();
    $strCenter = "null";
    if (($center != null) && ($center != ""))
    {
        $strCenter = "new GLatLng(" . $center . ")";
    }
    $label = $extData->GetLabel();
    $strLabel = ($label == null) ? "" : "\"" . $label . "\"";
?>

<noscript><b>JavaScript must be enabled in order for you to use Google Maps.</b>
  However, it seems JavaScript is either disabled or not supported by your browser.
  To view Google Maps, enable JavaScript by changing your browser options, and then
  try again.
</noscript>

<script type="text/javascript">
    if (GBrowserIsCompatible())
    {
        function runtest()
        {
            gMapWrapper.RunTest();
        }

//        var gMapWrapper = null;
        var gMapWrapper = new GMapsHandler(document.getElementById("map"),
                                    null,
                                    document.getElementById("err"),
                                    document.getElementById("idItemsList"),
                                    "url(loading.jpg)",
                                    <?php echo $strCenter . "," . $siteid . "," . $strLabel; ?>);

        if (gMapWrapper != null)
        {
//            gMapWrapper.LoadFromXmlFile("rickshawrun.xml", function() { gMapWrapper.DisplayMarkers(); });
            gMapWrapper.DisplayRoute(rgLocations, rgPts, rgTags);
        }
        else
        {
            alert("Failure!");
        }
    }
    else    // display a warning if the browser was not compatible
    {
        alert("Sorry, the Google Maps API is not compatible with this browser");
    }
</script>

<?php
require("footer.html");
?>