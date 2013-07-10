<?php
require_once("defines.php");
require_once("DBConnect.php");
require_once("BloggerData.php");

require("header.html");		// sets up $siteid

?>

<body onunload="GUnload()">
<script type="text/javascript">
    try
    {
        var rgPts = null;
<?php
    if ($siteid == null)
    {
        echo "} catch (e) {} </script>";
        echo "<h3>Please specify the site id</h3>";
        die;
    }
    echo "rgPts = [";
    $dbCon = new DBConnect();
	$query = preg_replace("/__SITEID__/", $siteid, QUERY_POINTS);
	$result = $dbCon->RunQuery($query);
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
	$labelparts = preg_split('/\s+/', $row->menulabel);
	$label = "";
	foreach ($labelparts as $part)
	{
		$label = $label . "<font size=\"20pt\">" . strtoupper(substr($part, 0, 1)) . "</font>" . substr($part, 1) . " ";
	}

	$query = preg_replace("/__SITEID__/", $siteid, QUERY_LAYOUT);
	$result = $dbCon->RunQuery($query);
	$layout = mysql_fetch_object($result);
?>
    }
    catch (e)
    {
        alert(e.message);
    }
</script>

	<div class="mainWidths">
<!-- top level navigation menu -->
<?php require("menu.php"); ?>

		<div class="mainBackground">
			<div class="boldText floatPicsDiv">
				<img src="<?php echo $layout->img1url; ?>" title="<?php echo $layout->img1title; ?>" width="200px" height="<?php echo $layout->img1height; ?>" class="floatPicsBrdr" />
				<img src="<?php echo $layout->img2url; ?>" title="<?php echo $layout->img2title; ?>" width="200px" height="<?php echo $layout->img2height; ?>" class="floatPicsBrdr floatPicsMargin" />
				<i><?php echo $layout->imgcaption; ?></i>
			</div>
			<div class="mainWidth floatMapDiv">
				<div class="mapTitleText">
					<?php echo $label ?>
				</div>
				<div id="map" class="mainWidth mapDiv"></div>
				<span class="paddingZoom">
					<a href="javascript:myzoom(1)">Zoom +1</a>&nbsp;&nbsp;&nbsp;
					<a href="javascript:myzoom(-1)">Zoom -1</a>
					<span class="boldText floatDateRange"><?php echo $dateRange; ?></span>
				</span>
			</div>
		<div class="newsfeedDiv">
			<div class="newsFeedHeaderWidth newsFeedIcon">
				<span class="newsFeedHeaderWidth newsFeedHeader">
					<span>
						<img class="sprite2 newsFeedSprite" src="img/blank.gif">
					</span>
					<span class="newsFeedText">News Feed
					</span>
				</span>
			</div>
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
			<td width="80%">
			<div class="newsItems">
<?php
    $extData = new ExternalData($siteid);
    $nNew = $extData->GetNewPosts();
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
			<td valign="top">
<?php
require("filter.php");
?>
			</td>
			</tr>
			</table>
				<div style="position:relative; top:-40px; left:-10px">
					<a href="#" style="background-image:url('/img/quark/bg-button-up-arrow-dark-brown-right.png'); color:#FFFFFF; padding-right:22px; background-position: right top; line-height:1; padding:0; background-repeat:no-repeat; font-size:1.3em; text-align:left; float:right; padding-right:22px;"><span style="background-image:url('/img/quark/bg-button-arrow-dark-brown-left.png'); height:29px; line-height:26px; padding-left:12px;background-position:left top; background-repeat:no-repeat; float:left; color:#FFFFFF">Back to Top</span></a></div>
		</div>
			<div style="text-align:center; border-top:15px solid #201212">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-7343873872957668";
/* Footer ad */
google_ad_slot = "4644684020";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
			</div>
		</div>
	</div>


<script type="text/javascript">
cssdropdown.startchrome("mainmenu")

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