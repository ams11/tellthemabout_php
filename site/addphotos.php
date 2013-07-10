<?php
define ('TITLE', 'Add Photos');
define ('TEMPLATE', 'blank');
require("header.html");
require_once("DBConnect.php");
date_default_timezone_set('America/Los_Angeles');
?>

<link href="/ext/css/menustyle.css" type="text/css" rel="stylesheet">
<div>
<div style="float:left" class="yui-skin-sam">
<form action="addalbum.php" method="post">
	Select Site: <select onchange="GetNamedElement(document, 'idsiteid').value = this.value;">
<?php
$result = $dbCon->RunQuery(QUERY_TRIPS);
$siteid1 = -1;
$sitedata = array();
while ($row = mysql_fetch_object($result))
{
	if ($siteid1 == -1)
	{
		$siteid1 = $row->siteid;
	}
?>
	<option value="<?php echo $row->siteid; ?>"><?php echo $row->menulabel . " (siteid = " . $row->siteid . ")"; ?></option>
<?php
}
?>
<script type="text/javascript">
function LimitLength(str, maxlen)
{
	str = str.substr(0, maxlen);
	return str + "...";
}
</script>
<option value="0">General (siteid = 0)</option>
</select><br />
	Title: <input name="title" onchange="GetNamedElement(document, 'title1').textContent = GetNamedElement(document, 'title2').textContent = GetNamedElement(document, 'title3').textContent = this.value;"></input><br />
	Date: <input name="date" onchange="GetNamedElement(document, 'date1').textContent = this.value;" value="<?php echo date('Y/m/d', time());?>"></input><br />
	Album URL: <input name="url" onchange="GetNamedElement(document, 'title1').href = GetNamedElement(document, 'title2').href = GetNamedElement(document, 'albumurl').href = this.value;"></input><br />
	# Photos: <input name="num" onchange="GetNamedElement(document, 'num1').textContent = this.value;"></input><br />
	Photo 1 img src: <input name="imgurl1" onchange="GetNamedElement(document, 'img1').src = this.value;"></input><br />
	Photo 1 page a href: <input name="url1" onchange="GetNamedElement(document, 'imgpage1').href = this.value;"></input><br />
	Photo 2 img src: <input name="imgurl2" onchange="GetNamedElement(document, 'img2').src = this.value;"></input><br />
	Photo 2 page a href: <input name="url2" onchange="GetNamedElement(document, 'imgpage2').href = this.value;"></input><br />
	Photo 3 img src: <input name="imgurl3" onchange="GetNamedElement(document, 'img3').src = this.value;"></input><br />
	Photo 3 page a href: <input name="url3" onchange="GetNamedElement(document, 'imgpage3').href = this.value;"></input><br />	
	Tags: <input name="tags" onchange="GetNamedElement(document, 'tagsText').textContent = this.value;"></input><br />
	Icon: <input name="icon" onchange="GetNamedElement(document, 'imgIcon').src = this.value;"></input><br />
	Description: <input name="description" onchange="GetNamedElement(document, 'descr').textContent = LimitLength(this.value, 90);"></input><br />
	<input name="siteid" type="hidden" id="idsiteid" value="<?php echo $siteid1; ?>"></input>
	<input type="submit" value="Submit" />
</form>
</div>
<div tagcount="10" id="div541" class="item" style="float:left; padding-left:50px; padding-top:20px">
<a target="_profile" href="http://www.facebook.com/profile.php?id=1046387715" title="Alex"><img src="http://profile.ak.fbcdn.net/hprofile-ak-snc4/hs304.ash1/23138_1046387715_5681_q.jpg" alt="Alex" class="itemPic" style="left:50px"></a>
<div class="itemBody">
<h3 id="idh3"><a href="#" id="title1" target="blog">&lt;Title Here&gt;</a></h3>
<span id="head" style="min-height: 16px;" class="itemHead">
<img src="/img/menu/blank.gif" style="margin-right: 5px; background-position: 0pt -990px; height: 15px ! important; width: 16px;" class="sprite">Posted by <a target="_profile" href="http://www.facebook.com/profile.php?id=1046387715&amp;ref=mf">Alex</a> on <span id="date1"><?php echo date('l, F j, Y', time());?></span>
</span>
<div id="itemPost" class="itemPost">
<span id="begin"><div id="picsDiv" class="picsDiv">
<div class="picDiv picDivMore"><a id="imgpage1" href="#" target="blog">
<div onmouseout="this.className='picInnerDiv';" onmouseover="this.className='picInnerDivMouseOver';" class="picInnerDiv"><img id="img1" src="" alt=""></div></a></div><div id="idPic2" class="picDiv picDivMore"><a id="imgpage2" href="#" target="blog">
<div onmouseout="this.className='picInnerDiv';" onmouseover="this.className='picInnerDivMouseOver';" class="picInnerDiv"><img id="img2" src="" alt=""></div></a></div><div id="idPic3" class="picDiv"><a id="imgpage3" href="" target="blog">
<div onmouseout="this.className='picInnerDiv';" onmouseover="this.className='picInnerDivMouseOver';" class="picInnerDiv"><img id="img3" src="" alt=""></div></a></div></div><div class="itemHead picCount"><span class="bold">photo album <a id="title2" href="#" target="blog">&lt;Title Here&gt;</a></span>:&nbsp;<span id="num1">&lt;##&gt;</span> new photos</div></span>
</div><div class="itemHead tagDiv"><span style="background: url(&quot;/img/tag.jpg&quot;) no-repeat scroll left center transparent; padding-left: 16px;" class="bold">Tags:&nbsp;</span><span id="tagsText">&lt;Tags Here&gt;</span></div></div>

<div class="md10dropmenudiv" style="visibility:visible; position:static; margin-top:30px; width:330px">
<a style="font-size:11px; padding: 6px" id="albumurl" href="#">
<div style="height:55px; width:250px;">
<div style="position:absolute; width: 60px; text-align:center"><img id="imgIcon" border="0" style="position: relative" src=""></div>
<div style="position: relative; left:75px; padding-right:5px">
<span style="font-weight:bold; position:relative; left:-4px" id="title3">&lt;Title Here&gt;</span><br />
<span id="descr">&lt;Description Here&gt;</span></div>
</div>
</a>
</div>

</div>

</div>

<?php
require("footer.html");
?>