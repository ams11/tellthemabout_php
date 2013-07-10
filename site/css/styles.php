<?php
/* 
    Document   : styles
    Created on : Nov 11, 2009, 11:06:08 PM
    Author     : Alex Slepak
    Description:
        Purpose of the stylesheet follows.
*/

header("Content-type: text/css");

require_once("../DBConnect.php");
require_once("../defines.php");

$siteid = DEFAULT_SITEID;
$template = null;
if (array_key_exists("siteid", $_GET))
{
	$siteid = $_GET["siteid"];
}

if (array_key_exists("template", $_GET))
{
	$template = $_GET["template"];
}

$dbCon = new DBConnect();
$query = preg_replace("/__SITEID__/", $siteid, QUERY_CSS);
$result = $dbCon->RunQuery($query);
$row = mysql_fetch_object($result);

$bgcolor = "white";
if ($template != "quark")
{
	$bgcolor = $row->bgcolor;
}

$bgrepeat = (($siteid == 4) && ($template != "quark")) ? "repeat" : "no-repeat";
?>

<?php
if ($template != 'blank')
{
?>
body {
	background-color: <?php echo $bgcolor; ?>;
	background-image: <?php echo $row->bgimg; ?>;
	background-repeat:<?php echo $bgrepeat; ?>;
	background-position:center;
	background-position:top;
}
<?php
}
?>

body, table {
    direction:ltr;
<?php
	if ($template != "quark")
	{
?>
    font-family:"lucida grande",tahoma,verdana,arial,sans-serif; 
    font-size:11px;
<?php
	}
?>
    text-align:left;
}

img {
border:0 none;
}

.mylink {
    -moz-background-clip:border;
    -moz-background-inline-policy:continuous;
    -moz-background-origin:padding;
    font-weight:bold;
    padding:0 11px 0 0;
    white-space:nowrap;
    color:#333333;
    direction:ltr;
    font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
    text-align:left;
    font-size:9px;
    background:transparent url(/img/more.gif) no-repeat scroll right 1px;
}

.mylinknobg {
    font-weight:bold;
    padding:0 11px 0 0;
    white-space:nowrap;
    color:#333333;
    direction:ltr;
    font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
    text-align:left;
    font-size:9px;
 }

.itemLess {
    display:none;
    padding-left:5px;
    background:transparent url(/img/more.gif) no-repeat scroll right -15px;
}
.itemLessVisible {
    padding-left:5px;
    background:transparent url(/img/more.gif) no-repeat scroll right -15px;
}

.loclink {
    font-size:11px;
}
A {
    color:#3B5998;
    outline-style:none;
    cursor:pointer;
    text-decoration:none;
}

A:hover {
    text-decoration:underline;
}

H3 {
    font-size:13px !important;
    color:#333333;
    margin:0;
    padding:0;
}

.item {
    position:relative;
}

.itemPic {
    position:absolute;
    padding-top:9px;
    height:50px;
    width:50px;
    left:0;
    border:0 none;
}

.itemBody {
    padding-left:60px;
    padding-top:8px;
    padding-bottom:8px;
    border-top:1px solid #EEEEEE;
    min-height:50px;
}

.itemPost {
    margin-top:3px;
    padding: 0 0 3px 8px;
    max-height:300px;
    overflow:auto;
    overflow-x:hidden;
    color:#333333;
}

.itemWBorderL {
    border-left:2px solid #CCCCCC;
}

.itemHead {
    clear:left;
    display:block;
    margin-top:3px;
    color:#777777;
}

.sprite {
	display: block;
	float:left;
	background-image:url(/img/sprite.png);
	background-repeat: no-repeat;
	border:0 none;
	margin-left:2px;
}

.sprite2 {
	display: block;
	float:left;
	background-image:url(/img/sprite2.png);
	background-repeat: no-repeat;
	border:0 none;
	margin-left:2px;
}

.tagDiv {
    font-size:11px;
    margin-left:3px;
    color:#777777;
}

.bold {
    font-weight:bold;
}

.markerDiv {
    width: 300px;
    max-height: 170px;
    overflow: auto;
    overflow-x: hidden;
}

.navDiv {
    width: 100%;
    text-align: center;
    padding-top: 4px;
}

.flagDiv {
    font-weight:bold;
}

.flagImg {
    float:right;
    padding-top:3px;
    padding-right:20px;
}

.picsDiv {
	overflow:hidden;
	padding-right:10px;
	padding-top:4px;
}

.picDiv {
	float:left;
}

.picDivMore {
	padding-right:8px;
}

.picInnerDiv {
	border:1px solid #CCCCCC;
	padding:3px;
}

.picInnerDivMouseOver {
	border:1px solid #3B5998;
	padding:3px;
}

.picCount {
	padding-top:7px;
}

.rrdd {
    color: white;
}

.mainWidths {
	width:963px;
	margin-top:180px;
	margin-left:142px;
}

.mainBackground {
	background-color:#ffffff;
	background-repeat:no-repeat;
	background-position:top left;
	background-image:url(<?php echo $row->bgimginner; ?>);
}

.boldText
{
	font-weight:bold;
	font-family:Geneva,Arial,Helvetica,sans-serif;
	color:#201212;
}

.floatPicsDiv {
	float:left;
	position: relative;
	top: 130px;
	left:25px;
	width: 200px;
	border: 0 none;
	text-align: center;
	font-size:9pt;
}

.floatPicsBrdr {
	border:1px solid #201212;
}

.floatPicsMargin {
	margin-top:12px;
}

.mainWidth {
	width: 610px;
}

.floatMapDiv {
	float:right;
	position:relative;
	top:-10px;
	left: -15px;
}

.mapTitleText {
	font-size:18pt;
	font-weight:bold;
	font-family:Monotype Corsiva, Lucida Handwriting, Papyrus, Geneva,Arial,Helvetica,sans-serif;
	color:rgb(166,18,18);
	text-align:center;
}

.mapDiv {
	height: 450px;
	border-style:solid;
	position:relative;
	top:-2px;
}

.paddingZoom {
	padding-left: 5px;
}

.floatDateRange {
	float:right;
	font-style:italic;
	padding-right:3px;
}

.newsfeedDiv {
	padding-top:515px;
	padding-left:25px;
}

.newsFeedHeaderWidth {
	width: 174px;
}

.newsFeedIcon {
	background: none repeat scroll 0pt 0pt rgb(216, 223, 234);
	padding: 5px 28px 5px 0px;
	position:relative;
	top:-25px;
}

.newsFeedHeader {
	line-height: 13px;
	text-align: left;
}

.newsFeedSprite {
	margin-right: 5px;
	background-position: 0pt -589px;
	height: 15px ! important;
	width: 16px;
}

.newsFeedText {
	font-weight: bold;
	color: rgb(51, 51, 51);
	font-size: 16px;
	vertical-align:bottom;
}

.newsItems {
	position:relative;
	top:-19px;
}