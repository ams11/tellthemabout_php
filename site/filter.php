<?php
require_once("DBConnect.php");
require_once("defines.php");

if ($siteid == null)
{
	$siteid = DEFAULT_SITEID;
}

$query = preg_replace("/__SITEID__/", $siteid, QUERY_SUSPECTS2);
$result = $dbCon->RunQuery($query);
$suspectdata = array();
while ($suspect = mysql_fetch_object($result))
{
	$suspectdata[] = array('name' => $suspect->name, 'url' => $suspect->url, 'icon' => $suspect->icon);
}

    $ie = (preg_match('/MSIE/i', $_SERVER['HTTP_USER_AGENT']))
?>

<!--CSS file (default YUI Sam Skin) -->
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.2r1/build/calendar/assets/skins/sam/calendar.css">
 
<!-- Dependencies -->
<script src="http://yui.yahooapis.com/2.8.2r1/build/yahoo-dom-event/yahoo-dom-event.js"></script>
 
<!-- Source file -->
<script src="http://yui.yahooapis.com/2.8.2r1/build/calendar/calendar-min.js"></script>

<div style="word-wrap:break-word; font-size:12px;">
	<ul style="list-style-type:none; margin:0; padding:0">
		<li style="padding-bottom:3px">
			<span style="width:18px; text-align:center; color:#333333l; line-height:13px">
				<img src="/img/menu/blank.gif" style="margin-right:3px; height:17px ! important; width:16px; background-position: 0pt -412px;" class="sprite2">
			</span>
			<span style="line-height:13px; color: #333333; text-decoration: none; padding-left:5px; font-weight: bold; font-size:13px">Search and Filter</span>
		</li>
		<li style="width:150px; margin-top:5px; padding-bottom:3px; padding-top:3px; background-color: #D8DFEA" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.cursor='';">
			<span style="width:18px; text-align:center; color:#333333l; line-height:13px">
				<img src="/img/menu/blank.gif" style="margin-right:3px; height:15px ! important; width:16px; background-position: 0pt -397px;" class="sprite2">
			</span>
			<span class="mylinknobg" style="font-size:11px; padding-left:5px; text-decoration:none"><a>Clear Filters</a></span>
		</li>
		<li style="width:150px; margin-top:3px; padding-bottom:3px; padding-top:3px" onmouseout="if (this.style.background != '#333333') this.style.background='';" onmouseover="if (this.style.background != '#333333') this.style.background='#EFF2F7 none repeat scroll 0 0';">
			<span style="width:18px; text-align:center; color:#333333l; line-height:13px">
				<img src="/img/menu/blank.gif" style="margin-right:3px; height:15px ! important; width:16px; background-position: 0pt -1320px;" class="sprite">
			</span>
			<span class="mylink" style="font-size:11px; padding-left:5px; text-decoration:none" onclick="ToggleFilterDiv(this);"><a>By Type</a></span>
			<div style="padding-left: 20px; padding-top:3px; display:none; font-weight:bold; font-size:11px" id="filterDiv">
				<input type="checkbox" checked onmouseup="SetBackground(this.parentNode); return true;">All</input>&nbsp;&nbsp;&nbsp;<input type="checkbox" id="none">None</input><br />
				<input type="checkbox" checked style="margin-top:8px">Location Updates</input><br />
				<input type="checkbox" checked>Blog Posts</input><br />
				<input type="checkbox" checked>Photos and Videos</input>
			</div>
		</li>
		<li style="width:150px; margin-top:3px; padding-bottom:3px; padding-top:3px" onmouseout="this.style.background='';" onmouseover="this.style.background='#EFF2F7 none repeat scroll 0 0';">
			<span style="width:18px; text-align:center; color:#333333l; line-height:13px">
				<img src="/img/menu/blank.gif" style="margin-right:3px; height:15px ! important; width:16px; background-position: 0pt -382px;" class="sprite2">
			</span>
			<span class="mylink" style="font-size:11px; padding-left:5px; text-decoration:none" onclick="ToggleFilterDiv(this);"><a>By Author</a></span>
			<div style="padding-left: 20px; padding-top:3px; display:none; font-weight:bold; font-size:11px" id="filterDiv">
				<input type="checkbox" checked>All</input>&nbsp;&nbsp;&nbsp;<input type="checkbox">None</input><br />
<?php
foreach ($suspectdata as $suspect)
{
?>
				<input type="checkbox" checked style="margin-top:8px"><?php echo $suspect['name']; ?></input><br />
<?php
}
?>
			</div>
		</li>
		<li style="width:150px; margin-top:3px; padding-bottom:3px; padding-top:3px" onmouseout="if (this.style.background != '#333333') this.style.background='';" onmouseover="if (this.style.background != '#333333') this.style.background='#EFF2F7 none repeat scroll 0 0';">
			<span style="width:18px; text-align:center; color:#333333l; line-height:13px">
				<img src="/img/menu/blank.gif" style="margin-right:3px; height:15px ! important; width:16px; background-image:url(/img/tag.jpg);" class="sprite">
			</span>
			<span class="mylink" style="font-size:11px; padding-left:5px; text-decoration:none" onclick="ToggleFilterDiv(this);"><a>By Tag</a></span>
			<div style="padding-left: 20px; padding-top:3px; display:none; font-weight:bold; font-size:11px" id="filterDiv">
				<input type="checkbox" checked onmouseup="SetBackground(this.parentNode); return true;">All</input>&nbsp;&nbsp;&nbsp;<input type="checkbox" id="none">None</input><br />
				<input type="checkbox" checked style="margin-top:8px">People</input><br />
				<input type="checkbox" checked>Places</input><br />
				<input type="checkbox" checked>Misc</input>
			</div>
		</li>
		<li style="width:170px; margin-top:3px; padding-bottom:3px; padding-top:3px;margin-bottom:5px" onmouseout="this.style.background='';" onmouseover="this.style.background='#EFF2F7 none repeat scroll 0 0';">
			<span style="width:18px; text-align:center; color:#333333l; line-height:13px">
				<img src="/img/menu/blank.gif" style="margin-right:3px; height:15px ! important; width:16px; background-position: 0pt -190px;" class="sprite2">
			</span>
			<span class="mylink" style="font-size:11px; padding-left:5px; text-decoration:none" onclick="ToggleFilterDivDate(this);"><a>By Date Range</a></span>
			<div style="padding-left: 25px; padding-top:6px; padding-bottom:10px; display:none; font-weight:bold; font-size:12px; width:200px" id="filterDiv" class="yui-skin-sam">
				<div>
					<span style="float:left; padding-right:5px; vertical-align:middle; width:35px">start: </span>
					<input type="text" id="dateField" autocomplete="off" class="auto-clear" value="<?php echo date('m/d/Y', $startDate); ?>" style="background-color:#FFFFFF; border:1px solid black; border-right: 0 none; float:left; vertical-align:middle; width:65px; height:14px; padding:2px 0 2px 1px; vertical-align:bottom;font-size:11px" onclick="cal1 = DisplayDatePicker('cal1Container', cal1, '<?php echo date('n/Y', $startDate);?>', '<?php echo date('n/j/Y', $startDate); ?>', true);" onload="this.value='<?php echo date('m/d/Y', $startDate); ?>';">
					<div id="dateFieldIcon" style="background: url('/img/menu/calendar.gif') no-repeat #FFFFFF center; border:1px solid black; border-left: 0 none; display:block; font-size:85%;height:18px;overflow:hidden;width:18px;vertical-align:bottom;cursor:pointer;float:left;padding-right:3px" onclick="cal1 = DisplayDatePicker('cal1Container', cal1, '<?php echo date('n/Y', $startDate);?>', '<?php echo date('n/j/Y', $startDate); ?>', false);"></div>
					<div style="height:24px; width:1px;float:left"></div>
					<span id="idDateTip" style="float:left; position:relative; top:-4px; font-weight:normal; font-size:10px; padding-left:42px; color:#999999"><?php echo date('D, M j Y', $startDate);?></span>
					<div id="cal1Container" style="display:none;"></div><br /><br /><br />
				</div>
				<div>
					<span style="float:left; padding-right:5px; vertical-align:middle; width:35px">end: </span>
					<input type="text" id="dateField" autocomplete="off"  class="auto-clear" value="<?php echo date('m/d/Y', $endDate); ?>" style="background-color:#FFFFFF; border:1px solid black; border-right: 0 none; float:left; vertical-align:middle; width:65px; height:14px; padding:2px 0 2px 1px; vertical-align:bottom;font-size:11px" onclick="cal2 = DisplayDatePicker('cal2Container', cal2, '<?php echo date('n/Y', $endDate);?>', '<?php echo date('n/j/Y', $endDate); ?>', true);" onload="this.value='<?php echo date('m/d/Y', $startDate); ?>';"/>
					<span id="dateFieldIcon" style="background: url('/img/menu/calendar.gif') no-repeat #FFFFFF center; border:1px solid black; border-left: 0 none; display:block; font-size:85%;height:18px;overflow:hidden;width:18px;vertical-align:bottom;cursor:pointer;float:left;padding-right:3px" onclick="cal2 = DisplayDatePicker('cal2Container', cal2, '<?php echo date('n/Y', $endDate);?>', '<?php echo date('n/j/Y', $endDate); ?>, false');"></span>
					<div style="height:24px; width:1px; float:left"></div>
					<span id="idDateTip" style="float:left; position:relative; top:-4px; font-weight:normal; font-size:10px; padding-left:42px; color:#999999"><?php echo date('D, M j Y', $endDate);?></span>
					<div id="cal2Container" style="display:none;"></div><br /><br />
				</div>
			</div>
		</li>
	</ul>
<form style="color: rgb(153, 153, 153);" accept-charset="utf-8" method="get" action="/searchresults.php" name="searchBox" id="searchBox">
<div class="clearfix">
<input type="text" id="searchString" name="searchString" title="Search" class="auto-clear" autocomplete="off" style="color: rgb(153, 153, 153);background-color:#FFFFFF; border:1px solid black; border-right: 0 none; float:left; font-size:14px; vertical-align:middle; width:130px; height:21px" />
<input type="hidden" value="null" id="page" name="page" />
<input type="hidden" value="<?php echo $siteid; ?>" id="siteid" name="siteid" />
<input type="submit" value="" class="submit" style="background: url('/img/menu/search.png') no-repeat #FFFFFF; border:1px solid black; border-left: 0 none; display:block; float:left; font-size:85%; height:25px;overflow:hidden;width:18px;vertical-align:middle;cursor:pointer;" />
</div>
</form>
<br /><br /><div style="display:none; color:red; font-size:10px; margin-top:10px; width:150px" id="nosearch">
<img src="/img/menu/safety3rd.png" style="padding-right:5px"/>Search and Filter functionality is not yet available - this is merely a UI preview
</div>

<script type="text/javascript">
var cal1 = null;
var cal2 = null;

function ToggleFilterDiv(obj)
{
	if (obj.className == 'mylink')		// child DIV not showing
	{
		obj.className = 'mylink itemLessVisible';
		try 
		{
			GetNamedElement(obj.parentNode, "filterDiv").style.display = "block";
			GetNamedElement(document, "nosearch").style.display = "block";		// BUGBUG - get rid of me!
		}
		catch (e)
		{
			alert(e.description);
		}
	}
	else								// child DIV showing
	{
		obj.className = 'mylink';
		GetNamedElement(obj.parentNode, "filterDiv").style.display = "none";
	}
}

function ToggleFilterDivDate(obj)
{
	try
	{
		var fNoChild = (obj.className == 'mylink');		// child DIV not showing
		ToggleFilterDiv(obj);
		if (!fNoChild)		// if the child is showing
		{
			var rgDateControls = new Array(cal1, cal2);
			for (var i=0; i < rgDateControls.length; i++)
			{
				var cal = rgDateControls[i];
				if (cal != null)
				{
					cal.dateField.style.borderColor = cal.dateFieldIcon.style.borderColor = 'black';
					cal.divParent.style.display = "none";
				}
			}
		}
	}
	catch(e)
	{
		alert(e.description);
	}
}

function DisplayDatePicker(id, objCalendar, pagedate, selected, donthide)
{
	try
	{
		var div = GetNamedElement(document, id);
		if (div.style.display == "none")		// we need to display the date-picker control
		{
			div.style.display = "";
			if (objCalendar == null)			// initial setup
			{
				objCalendar = new Object();
				objCalendar.dateField = GetNamedElement(div.parentNode, "dateField");
				objCalendar.dateFieldIcon = GetNamedElement(div.parentNode, "dateFieldIcon");
				objCalendar.dateTip = GetNamedElement(div.parentNode, "idDateTip");
				objCalendar.divParent = div;
				var cal = new YAHOO.widget.Calendar(id);
				cal.cfg.setProperty("pagedate", pagedate, false);
				cal.cfg.setProperty("selected", selected, false);
				cal.cfg.setProperty("navigator", true, false);
				cal.cfg.setProperty("close", true, false);
				objCalendar.calendar = cal;
				objCalendar.calendar.selectEvent.subscribe(function() {DisplayDatePicker(id, objCalendar, pagedate, selected, false);});
				objCalendar.calendar.hideEvent.subscribe(function() {objCalendar.dateField.style.borderColor = objCalendar.dateFieldIcon.style.borderColor = 'black'; });
				objCalendar.calendar.render();
			}
			// post-production
			objCalendar.dateField.style.borderColor = objCalendar.dateFieldIcon.style.borderColor = 'orange';
		}
		else if (!donthide)		// hide the date picker and update the appropriate date field
		{
			if ((objCalendar != null) && (objCalendar.calendar != null))
			{
				var arrDates = objCalendar.calendar.getSelectedDates();
				var newDate = new Date(arrDates[0])
				objCalendar.dateField.value = newDate.format('m/d/Y');
				objCalendar.dateTip.innerHTML = newDate.format('D, M j Y');
			}

			objCalendar.dateField.style.borderColor = objCalendar.dateFieldIcon.style.borderColor = 'black';
			div.style.display = "none";
		}
	}
	catch (e)
	{
		alert(e.description);
	}
	
	return objCalendar;
}

function SetBackground(obj)
{
	var rgInputs = obj.getElementsByTagName("input");
	var fDefault = true;
	for (var i=0; i < rgInputs.length; i++)
	{
		if (rgInputs[i].id == "none")
			continue;
		fDefault &= rgInputs[i].checked;
		if (!fDefault)
			break;
	}
	
	if (!fDefault)
	{
//		obj.style.background = "cyan";
	}
}
</script>