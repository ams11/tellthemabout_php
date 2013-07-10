<?php

require_once("DBConnect.php");
require_once("defines.php");

function LimitLength($string, $maxlength)
{
	if (strlen($string) > $maxlength)
	{
		$i = $maxlength - 5;
		for ($i = $maxlength - 5; $i < $maxlength; $i++)
		{
			if ($string[$i] == ' ')
				break;
		}
		$string = substr($string, 0, $i) . "...";
	}

	return $string;
}

if ($siteid == null)
{
	$siteid = DEFAULT_SITEID;
}

$dbCon = new DBConnect();
// get the list of other sites
$result = $dbCon->RunQuery(QUERY_TRIPS);

$sitedata = array();
while ($row = mysql_fetch_object($result))
{
	date_default_timezone_set($row->timezone);
	$sitedata[] = array('siteid' => $row->siteid, 'label' => $row->menulabel, 'dates' => $dbCon->FormatDateRange($row->startdate, $row->enddate, false), 'description' => $row->description, 'icon' => $row->icon);
}
	
// get the photo albums from this site
$query = preg_replace("/__SITEID__/", $siteid, QUERY_ALBUMS);
$result = $dbCon->RunQuery($query);
$albumdata = array();
while ($row = mysql_fetch_object($result))
{
	$description = LimitLength($row->description, 90);
	$albumdata[] = array('title' => $row->title, 'icon' => $row->icon, 'url' => $row->url, 'description' => $description);
}

// get the recent blog posts from this site
$query = preg_replace("/__SITEID__/", $siteid, QUERY_POSTSTOP5);
$result = $dbCon->RunQuery($query);
$blogdata = array();
while ($row = mysql_fetch_object($result))
{
	$blogdata[] = array('title' => $row->title, 'url' => $row->url, 'date' => date('l, F d, Y', strtotime($row->date)));
}

// get the latest photo album for the blog
$result = $dbCon->RunQuery(QUERY_BLOG_PHOTOS);
$row = mysql_fetch_object($result);		// just get the one
$blogpics = array('title' => $row->title, 'url' => $row->url, 'icon' => $row->icon, 'description' => $row->description);

$query = preg_replace("/__SITEID__/", $siteid, QUERY_SUSPECTS);
$result = $dbCon->RunQuery($query);
$suspectdata = array();
while ($row = mysql_fetch_object($result))
{
	$query = preg_replace("/__SUSPECTID__/", $row->suspectid, QUERY_SUSPECT);
	$result2 = $dbCon->RunQuery($query);
	$suspect = mysql_fetch_object($result2);
	
	$trips = "";
	// now get all the trips this person has been a part of
	$query = preg_replace("/__SUSPECTID__/", $row->suspectid, QUERY_SITES);
	$result3 = $dbCon->RunQuery($query);
	while ($trip = mysql_fetch_object($result3))
	{
		$trips .= ($trip->menulabel . "; ");
	}
	$suspectdata[] = array('name' => $suspect->name, 'url' => $suspect->url, 'icon' => $suspect->icon, 'trips' => $trips);
}

function EmitPictureMenuItem($url, $icon, $label, $morelabel, $description)
{
	$label = LimitLength($label, 38);
?>
<a style="font-size:11px; padding: 6px" href="<?php echo $url; ?>">
<div style="height:55px; width:250px;">
<div style="position:absolute; width: 60px; text-align:center"><img border="0" style="position: relative" src="<?php echo $icon; ?>"></div>
<div style="position: relative; left:75px; padding-right:5px">
<span style="font-weight:bold; position:relative; left:-4px"><?php echo $label; ?></span><?php echo $morelabel; ?><br />
<?php echo $description; ?></div>
</div>
</a>
<?php
}
if ($siteid == 4)
{
?>
<div style="background-image:url('/img/layout/Header_AR_icebergs31_2010.jpg');position:absolute; top: 0; left:0; width:100%; height:317px; z-index:-1"></div>
<?php
}
$rel = (($siteid == 1) || ($siteid == 4)) ? "rel='rrdropmenu'" : "";
?>

<script src="/ext/js/dropdownmenu.js" type="text/javascript"></script>

<link href="/ext/css/menustyle.css" type="text/css" rel="stylesheet">

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>


<td bgcolor="#222222">

<div id="mainmenu" class="md10style">
<ul>
<li style="border: medium none; height:50px; padding:0; width:25px; float:left; margin:0"><a <?php echo $rel; ?> href="index.php?siteid=<?php echo $siteid; ?>" style="margin:0 0 0 -32px;border:none">
<img src="/img/menu/safety3rdbw-transp.png" style="position:relative; left:-14px; top:-3.5px" title="Home"></a>
</li>
<li style="border-right:1px solid #2F2F2F"><a <?php echo $rel; ?> href="index.php?siteid=<?php echo $siteid; ?>">HOME</a></li>
<li style="border-right:1px solid #2F2F2F"><a rel="rrdropmenu0" href="#">MORE TRIPS</a></li>
<li style="border-right:1px solid #2F2F2F"><a rel="rrdropmenu1" href="http://safety3rd.blogspot.com">BLOG</a></li>
<li style="border-right:1px solid #2F2F2F"><a rel="rrdropmenu2" href="albums.php?siteid=<?php echo $siteid; ?>">PHOTOS</a></li>
<li style="border-right:1px solid #2F2F2F"><a rel="rrdropmenu3" href="#">TOOLS</a></li>
<li style="border-right:1px solid #2F2F2F"><a rel="rrdropmenu4" href="contact.php?siteid=<?php echo $siteid; ?>">GET IN TOUCH</a></li>

<li id="md10search">
<div style="position:relative; float:right; padding-top: 14px; padding-right:20px" >
<form style="color: rgb(153, 153, 153);" accept-charset="utf-8" method="get" action="/searchresults.php" name="searchBox" id="searchBox">
<div class="clearfix">
<input type="text" id="searchString" name="searchString" title="Search" class="auto-clear" autocomplete="off" style="color: rgb(153, 153, 153);background-color:#FFFFFF; border:0 none; float:left; font-size:14px; vertical-align:middle; width:200px; height:21px">
<input type="hidden" value="null" id="page" name="page">
<input type="hidden" value="<?php echo $siteid; ?>" id="siteid" name="siteid">
<input type="submit" value="" class="submit" style="background: url('/img/menu/search.png') no-repeat #FFFFFF; border:0 none; display:block; float:left; font-size:85%; height:23px;overflow:hidden;width:18px;vertical-align:middle;cursor:pointer">
</div>
</form>
</div>
</li>

</ul>


</div>

<!-- Other Trips drop down menu -->
<div style="width: 330px; top: 1px; left: 118px; clip: rect(0pt, auto, 572.75px, 0pt); visibility: hidden;font-family:lucida grande,tahoma,verdana,arial,sans-serif;direction:ltr;font-size:11px;text-align:left" class="md10dropmenudiv" id="rrdropmenu0">
<?php
foreach ($sitedata as $site)
{
	EmitPictureMenuItem("index.php?siteid=" . $site['siteid'], $site['icon'], $site['label'], "&nbsp;&nbsp;(" . $site['dates'] . ")", $site['description']);
}
?>
</div>



<!--Blogs menu-->
<div style="width: 660px; top: 231px; left: 397px; clip: rect(0pt, auto, 572.75px, 0pt); visibility: hidden;" class="md10dropmenudiv" id="rrdropmenu1">

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>

<?php
$count = 0;

$column2 = array();
$column2[0] = array('title' => 'Safety Third!', 'description' => 'Three years and counting, being unsafe across seven continents!', 'url' => 'http://safety3rd.blogspot.com', 'icon' => '/img/menu/safety3rd.jpg');
$column2[1] = array('title' => 'Akademik Ioffe', 'description' => 'Breath-taking two weeks cruising Antarctica', 'url' => 'http://akademikioffe.blogspot.com/', 'icon' => '/img/menu/quark.jpg');
$column2[2] = array('title' => 'Rustbox.360', 'description' => 'Mongol Rally, attempt #1. Aboard a Soviet-built LADA tank, summer 2006', 'url' => 'http://rustbox360.blogspot.com/', 'icon' => '/img/menu/lada.jpg');
$column2[3] = array('title' => $blogpics['title'], 'description' => $blogpics['description'], 'url' => $blogpics['url'], 'icon' => $blogpics['icon']);

$blogicon = "/img/menu/safety3rd.jpg";
if ($siteid == 4)
{
	$blogicon = "/img/menu/quark.jpg";
	$safety3rd = $column2[0];
	$column2[0] = $column2[1];
	$column2[1] = $safety3rd;
}

foreach($blogdata as $post)
{
?>
<tr>
<td valign="top" align="left" width="330px">
<?php
	EmitPictureMenuItem(urldecode($post['url']), $blogicon, $post['title'], "", $post['date']);
?>
</td>
<td valign="top" align="left" width="330px">
<?php
	EmitPictureMenuItem($column2[$count]['url'], $column2[$count]['icon'], $column2[$count]['title'], "", $column2[$count]['description']);
?>
</td>
</tr>
<?php
$count++;
}?>
</tbody></table>
</div>

<!--Photos drop down menu -->
<div style="width: 660px; top: 231px; left: 264px; clip: rect(0pt, auto, 279.75px, 0pt); visibility: hidden;" class="md10dropmenudiv" id="rrdropmenu2">

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>

<?php
$count = 0;
foreach ($albumdata as $album)
{
?>

<td valign="top" align="left" width="330px">

<?php
	EmitPictureMenuItem($album['url'], $album['icon'], $album['title'], "", $album['description']);
?>


</td>

<?php
$count++;
if (($count % 2) == 0)
{
	echo "</tr><tr>";
}
}
?>
</tr><tr>
<td colspan="2" align="center" valign="top" class="rrdd" style="padding-top:10px;padding-bottom:10px; padding-left:200px; padding-right:200px"><a href="albums.php?siteid=<?php echo $siteid; ?>"><strong>More Photo Albums ...</strong></a></td></tr>
</tbody></table>
</div>

<!--Tools drop down menu -->
<div style="width: 150px; top: 231px; left: 397px; clip: rect(0pt, auto, 94.8717px, 0pt); visibility: hidden;" class="md10dropmenudiv" id="rrdropmenu3">
  <a href="http://twitter.com/aslepak" target="blog">Twitter Feed</a>
  <a href="http://thewebsitemetablog.blogspot.com/">The Website Blog</a>
  <a href="/known.php?siteid=<?php echo $siteid; ?>">Known Issues</a>
  <a href="/report.php?siteid=<?php echo $siteid; ?>">Report an Issue</a>
  <a href="/admin.php?siteid=<?php echo $siteid; ?>">Admin Console</a>
</div>

<!--Home drop down menu -->
<?php if ($rel)
{
$index = -1;		// error!
if ($siteid == 1)
{
	$index = 3;
}
else if ($siteid == 4)
{
	$index = 2;
}
?>
<div style="width: 330px; top: 231px; left: 397px; clip: rect(0pt, auto, 572.75px, 0pt); visibility: hidden;" class="md10dropmenudiv" id="rrdropmenu">

<?php
	EmitPictureMenuItem("index.php?siteid=" . $siteid, $sitedata[$index]['icon'], $sitedata[$index]['label'], "", $sitedata[$index]['description']);
	if ($siteid == 1)		// Rickshaw Run
	{
		EmitPictureMenuItem("/india.php", "/img/menu/logominicirc.png", "The Adventurists", "", "The Adventurists organize the Rickshaw Run. Switch view to a template based on their site");
	}
	else
	{
		EmitPictureMenuItem("/circle.php", "/img/menu/quark.jpg", "Quark Expeditions", "", "Switch to a Quark Expeditions site template");
	}
?>
</div>
<?php
}
?>

<!--CONTACT drop down menu -->
<div style="width: 330px; top: 231px; left: 397px; clip: rect(0pt, auto, 572.75px, 0pt); visibility: hidden;" class="md10dropmenudiv" id="rrdropmenu4">

<?php
	EmitPictureMenuItem("/contact.php?siteid=" . $siteid, "/img/menu/email.jpg", "Send us a message", "", "");
?>

<table width="100%" cellspacing="5" cellpadding="0" border="0">
<tbody><tr>
<td class="rrdd" valign="top" align="center" style="font-size: 10pt">
<div style="width:150px; height:100%">
	<a href="/suspects.php?siteid=<?php echo $siteid; ?>"><b>The Suspects:</b></div></a>
</td>
</tr>
</tbody></table>

<?php
foreach ($suspectdata as $person)
{
	EmitPictureMenuItem($person['url'], $person['icon'], $person['name'], "", $person['trips']);
}
?>

</div>

</td>
  </tr>
</tbody></table>