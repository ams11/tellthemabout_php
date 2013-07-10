<?php
require_once("defines.php");
define('SITEID', 1);
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
	$siteid = DEFAULT_SITEID;
}
require("header.html");
require_once("DBConnect.php");
require_once("BloggerData.php");

$query = preg_replace("/__SITEID__/", $siteid, QUERY_TRIP);
$result = $dbCon->RunQuery($query);
$row = mysql_fetch_object($result);
$startDate = strtotime($row->startdate);
$endDate = strtotime($row->enddate);
?>

<body onunload="GUnload()">
<script type="text/javascript">
    try
    {
        var rgPts = null;
<?php
echo "rgPts = [";
$dbCon = new DBConnect();
$query = preg_replace("/__SITEID__/", $siteid, QUERY_POINTS);
$result = $dbCon->RunQuery($query);
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

<div class="mainWidths">

<?php require("rrmenu.php"); ?>		<!-- top level navigation menu -->

	<div style="background-color:#ffffff">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td width="330px" valign="top" style="padding-top:25px">
					<div style="text-align:center">
						<img src="img/sfty3rd.jpg" alt="Safety Third!" />
						<h1>Safety Third!</h1>
					</div>
					<div style="margin-left:20px; margin-right:20px">
					<div style="font-size: 11px; margin-top:0px; margin-bottom:15px; margin-left:75px;width:150px">
						<ul style="list-style-type:none;margin:0; padding:0">
						<li style="background:#D8DFEA none repeat scroll 0 0;padding:3px 28px 4px 0px;border-bottom:1px solid #FFFFFF;">
							<a href="" style="line-height:13px; text-align:left; width:200px">
								<span>
								<img src="/img/menu/blank.gif" style="margin-right: 5px; background-position: 0pt -589px; height: 15px ! important; width: 16px;" class="sprite2" />
								</span>
								<span style="font-weight:bold; color:#333333; font-size:12px">News Feed</span>
							</a>
						</li>
						<li style="padding:3px 12px 4px 0px" onmouseover="this.style.background='#EFF2F7 none repeat scroll 0 0';" onmouseout="this.style.background='';">
							<a target="_old" href="http://rickshawrun08w.theadventurists.com/index.php?mode=team&sub=display&pagemode=route&teamid=305&name=SafetyThird">
								<img src="/img/menu/blank.gif" style="margin-right: 5px; background-position: 0pt -365px; height: 16px ! important; width: 16px;" class="sprite2" />
								<span style="color:#333333; font-size:12px">Route</span>
							</a>
						</li>
						<li style="padding:3px 12px 4px 0px" onmouseover="this.style.background='#EFF2F7 none repeat scroll 0 0';" onmouseout="this.style.background='';">
							<a target="_old" href="http://rickshawrun08w.theadventurists.com/index.php?mode=team&sub=display&pagemode=blog&name=SafetyThird">
								<img src="/img/menu/blank.gif" style="margin-right: 5px; background-position: 0pt -1320px; height: 15px ! important; width: 16px;" class="sprite" />
								<span style="color:#333333; font-size:12px">Blog</span>
							</a>
						</li>
						<li style="padding:3px 12px 4px 0px" onmouseover="this.style.background='#EFF2F7 none repeat scroll 0 0';" onmouseout="this.style.background='';">
							<a target="_old" href="http://rickshawrun08w.theadventurists.com/index.php?mode=team&sub=display&pagemode=gallery&teamid=305&name=SafetyThird">
								<img src="/img/menu/blank.gif" style="margin-right: 5px; background-position: 0pt -829px; height: 15px ! important; width: 16px;" class="sprite2" />
								<span style="color:#333333; font-size:12px">Photos and Videos</span>
							</a>
						</li>
						<li style="padding:3px 12px 4px 0px" onmouseover="this.style.background='#EFF2F7 none repeat scroll 0 0';" onmouseout="this.style.background='';">
							<a target="_old" href="http://rickshawrun08w.theadventurists.com/index.php?mode=team&sub=display&pagemode=charities&name=SafetyThird">
								<img src="/img/menu/blank.gif" style="margin-right: 5px; background-position: 0pt -717px; height: 15px ! important; width: 16px;" class="sprite2" />
								<span style="color:#333333; font-size:12px">Charities</span>
							</a>
						</li>
						<li style="padding:3px 12px 4px 0px" onmouseover="this.style.background='#EFF2F7 none repeat scroll 0 0';" onmouseout="this.style.background='';">
							<a target="_old" href="http://rickshawrun08w.theadventurists.com/index.php?mode=team&sub=display&pagemode=team_members&name=SafetyThird">
								<img src="/img/menu/blank.gif" style="margin-right: 5px; background-position: 0pt -1402px; height: 15px ! important; width: 16px;" class="sprite2" />
								<span style="color:#333333; font-size:12px">Our Vehicle</span>
							</a>
						</li>
						<li style="padding:3px 12px 4px 0px" onmouseover="this.style.background='#EFF2F7 none repeat scroll 0 0';" onmouseout="this.style.background='';">
							<a target="_old" href="http://rickshawrun08w.theadventurists.com/index.php?mode=team&sub=display&pagemode=sponsors&name=SafetyThird">
								<img src="/img/menu/blank.gif" style="margin-right: 5px; background-position: 0pt -1182px; height: 15px ! important; width: 16px;" class="sprite2" />
								<span style="color:#333333; font-size:12px">Sponsors</span>
							</a>
						</li>
						<li style="padding:3px 12px 4px 0px" onmouseover="this.style.background='#EFF2F7 none repeat scroll 0 0';" onmouseout="this.style.background='';">
							<a target="_old" href="http://rickshawrun08w.theadventurists.com/index.php?mode=team&sub=display&pagemode=team_members&name=SafetyThird">
								<img src="/img/menu/blank.gif" style="margin-right: 5px; background-position: 0pt -381px; height: 15px ! important; width: 16px;" class="sprite2" />
								<span style="color:#333333; font-size:12px">The Team</span>
							</a>
						</li>
						</ul>
					</div>

				</td>
				<td>
					<div id="map" style="width: 600px; height: 500px; border-style:solid; margin-bottom:15px; margin-top:10px"></div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<table border="0" cellspacing="0" cellpadding="0" width="100%">
						<tr>
						<td width="80%">
						<div class="newsItems" style="margin-left:25px; margin-top:20px">

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
					<td valign="top" style="padding-top:10px">
<?php
require("filter.php");
?>
					</td>
					</tr>
					</table>
				</td>
			</tr>
		</table>
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