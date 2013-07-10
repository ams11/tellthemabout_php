<head>
<link type="image/png" href="/img/menu/safety3rd.png" rel="shortcut icon">
<style type="text/css">
body {
	background-color: #201212;
	background-image: url("/img/layout/bg.jpg");
	background-repeat:no-repeat;
	background-position:center;
	background-position:top; }
</style>

</head>

<?php
define('SITEID', '3');
define ('TITLE', 'Africa Awaits');
require("../header.html");
require_once("../DBConnect.php");
require_once("../BloggerData.php");
require_once("../defines.php");
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
	
	$query = preg_replace("/__SITEID__/", $siteid, QUERY_TRIP);
	$result = $dbCon->RunQuery($query);
	$row = mysql_fetch_object($result);
	$dateRange = $dbCon->FormatDateRange($row->startdate, $row->enddate, true);
	$startDate = strtotime($row->startdate);
	$endDate = strtotime($row->enddate);	
?>
    }
    catch (e)
    {
        alert(e.message);
    }
</script>

    <table width="963" border="0" align="center" cellpadding="0" cellspacing="0">
        <tbody
            <tr>
                <td valign="top" align="right" height="180">
                    <a href="#"><img width="150" border="0" align="left" height="150" alt="The Rickshaw Run" src="/img/menu/blank.gif"></a>
                </td>
            </tr>
            <tr>
                <td>


<!-- top level navigation menu -->
<?php require("../menu.php"); ?>


                </td>
            </tr>
			<tr>
			<td style="background-color:#ffffff; background-image:url('/img/menu/nafrica.jpg'); background-repeat:no-repeat; background-position:left top;" >
			
			<div style="position:relative">
			<div style="border: 0 none; left:25px; width: 200px; top:130px; position:absolute; text-align:center; font-weight:bold; font-size:9pt;font-family:Geneva,Arial,Helvetica,sans-serif; color:#201212"><img src="/img/menu/pyramids.jpg" title="The Pyramids of Giza - Cairo, Egypt, Africa"width="200px" height="153px" style="border:1px solid #201212"/><br /><br /><img src="/img/menu/inegypt.jpg" title="The World Wide adventure reaches Cairo and continent #7" width="200px" height="141px" style="border:1px solid #201212"/><i>Africa reached on May 30, 2010</i></div>

<div style="border: 0 none; padding-left:335px;">
    <table width="100%" border="0">
        <tr valign="top">
            <td>
                <div style="width: 600px; height: 512px"><div style="font-size:18pt;font-weight:bold;padding-top:0px; padding-bottom:0px; font-family:Monotype Corsiva, Lucida Handwriting, Papyrus, Geneva,Arial,Helvetica,sans-serif; color:rgb(166,18,18)"><center><font size="20pt">A</font>frica <font size="20pt">A</font>waits</center></div><div id="map" style="width: 600px; height: 450px; border-style:solid"></div></div>
            </td>
            <td align="left" style="display:">
				<div style="padding:5px">
				</div>
                <div style="border-width:thick;overflow:auto;max-height:350px;display:<?php echo $errdisp; ?>" id="err"></div>
            </td>
        </tr>
    </table>
	<span style="padding-left: 5px; padding-bottom:15px; padding-top:5px;">
		<a href="javascript:myzoom(1)">Zoom +1</a>&nbsp;&nbsp;&nbsp;
		<a href="javascript:myzoom(-1)">Zoom -1</a>
		<span style="float:right; font-style:italic; font-weight:bold; padding-right:25px; font-family:Geneva,Arial,Helvetica,sans-serif; color:#201212"><?php echo $dateRange; ?></span><br />
	</span>
    <br />
</div>

<div style="padding-left:25px">
<div style="background: none repeat scroll 0pt 0pt rgb(216, 223, 234); padding: 5px 28px 5px 0px; border-bottom: 1px solid rgb(255, 255, 255); width:174px; position:absolute; top:510px">
										<span style="line-height: 13px; text-align: left; width: 174px;">
											<span>
											<img class="sprite2" style="margin-right: 5px; background-position: 0pt -589px; height: 15px ! important; width: 16px;" src="/img/menu/blank.gif">
											</span>
											<span style="font-weight: bold; color: rgb(51, 51, 51); font-size: 16px; vertical-align:bottom;">News Feed</span>
										</span>
									</div>
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
</div>


                </td>
            </tr>
        </tbody>
    </table>

<script type="text/javascript">
cssdropdown.startchrome("mainmenu")
</script>

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
require("../footer.html");
?>