<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html class="js" xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<meta content="en-us" http-equiv="content-language">
		
		<title>Antarctic Circle Expedition Trip Log | Quark Expeditions</title>
		<link type="image/x-icon" href="/img/quark/quark.ico" rel="shortcut icon">

		<link media="all" href="/ext/css/quark-all.css" type="text/css" rel="stylesheet">
		<link media="print" href="/ext/css/quark-print.css" type="text/css" rel="stylesheet">
		

		
	</head>
	
<?php
define('SITEID', '4');
define('TEMPLATE', 'quark');
define ('TITLE', 'Arctic Circle Expedition - February 2009');
require("header.html");
require_once("DBConnect.php");
require_once("BloggerData.php");
require_once("defines.php");
?>

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

<body class="js">	
	<div class="page layout-2">
<div class="header">
    	<div class="header-inner">
            <div class="logo-strapline">
                <p class="logo"><a href="http://www.quarkexpeditions.com/"><img height="67" width="195" src="/img/quark/logo-quark-expeditions.gif" alt="Quark Expeditions"></a></p>
                <p class="strapline">The Leader in <span>Polar Adventures</span></p>
            </div>
            <div class="quick-links">  <ul><li class="first"><a title="Brochure" href="http://www.quarkexpeditions.com/brochures">Brochures</a></li><li><a title="e-Newsletter" href="http://www.quarkexpeditions.com/enewsletter">E-NEWSLETTER</a></li><li><a target="_blank" title="The Quark Gear Shop" href="http://quarkexpeditions.newheadingsllc.com/">Gear Shop</a></li><li><a title="" href="http://www.quarkexpeditions.com/blog">Blog</a></li></ul></div>
            <div class="search-login">
		
        
                <form class="search" id="search-theme-form" method="post" accept-charset="UTF-8" action="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/overview">
 <input type="text" class="form-text text rounded-text" value="" id="search-box" name="search-box" maxlength="128">
<input type="hidden" value="form-4b2a766264e34a19b3ba98742639049d" id="form-4b2a766264e34a19b3ba98742639049d" name="form_build_id">
<input type="hidden" value="quark_search_box_form" id="edit-quark-search-box-form" name="form_id">
<button class="button form-submit button-arrow" type="submit" value="Search" name="op"><span>Search</span></button>

</form>
                
                <p class="login"><a class="button button-arrow-brown" href="http://www.quarkexpeditions.com/user?destination=node%2F255"><span>My Quark Login/Register</span></a></p>
            </div>
            <div class="check-availability">
	
	
		<form id="tripsearch-block-form" method="get" accept-charset="UTF-8" action="http://www.quarkexpeditions.com/expedition-search">
<h2>Check Availability &amp; Book</h2><div class="field clear"> <label for="edit-Region">Region:</label>
<select id="edit-Region" class="" name="Region"><option selected="selected" value="">Any Region</option><option value="Arctic">Arctic</option><option value="Antarctica">Antarctica</option><option value="North Pole">North Pole</option></select>
</div><div class="field clear"> <label for="edit-Month">Month:</label>
<select id="edit-Month" class="" name="Month"><option value="0">Any Month</option><option value="08/2010">August 2010</option><option value="10/2010">October 2010</option><option value="11/2010">November 2010</option><option value="12/2010">December 2010</option><option value="01/2011">January 2011</option><option value="02/2011">February 2011</option><option value="06/2011">June 2011</option><option value="07/2011">July 2011</option><option value="08/2011">August 2011</option><option value="09/2011">September 2011</option><option value="11/2011">November 2011</option><option value="12/2011">December 2011</option><option value="01/2012">January 2012</option><option value="02/2012">February 2012</option></select>
</div><div class="field clear"> <label for="edit-Ship">Ship:</label>
<select id="edit-Ship" class="" name="Ship"><option value="0">Any Ship</option><option value="VIC">50 Years of Victory</option><option value="IOF">Akademik Ioffe</option><option value="VAV">Akademik Sergey Vavilov</option><option value="CPA">Clipper Adventurer</option><option value="KLB">Kapitan Khlebnikov</option><option value="OCN">Ocean Nova</option><option value="SEA">Sea Spirit - Quark's First Luxurious Vessel</option></select>
</div><div class="field clear"> <label for="edit-Price">Price:</label>
<select id="edit-Price" class="" name="Price"><option value="0">Any Price Range</option><option value="0:4000">&lt; $4000</option><option value="4000:7000">$4000 - $7000</option><option value="7000:10000">$7000 - $10000</option><option value="10000:15000">$10000 - $15000</option><option value="15000:20000">$15000 - $20000</option><option value="20000:200000">&gt; $20000</option></select>
</div><input type="hidden" value="form-407e6c3441ab6aecec692c0396bf86bf" id="form-407e6c3441ab6aecec692c0396bf86bf" name="form_build_id">
<input type="hidden" value="tripsearch_block_form" id="edit-tripsearch-block-form" name="form_id">
<button class="button form-submit button-arrow" type="submit" value="Explore" name="op"><span>Explore</span></button>
<p class="advanced-search"><a href="http://www.quarkexpeditions.com/expedition-search?advanced=true">Advanced Search</a></p>
</form>
</div>
        </div><!-- end -->
    </div>		<!-- class="header" -->
	<div class="container">
		<div class="navigation">
        	<ul class="clear"><li class="first "><a href="http://www.quarkexpeditions.com/"><span>Home</span></a></li><li class="active has-flyout"><a href="http://www.quarkexpeditions.com/antarctic-expeditions"><span>Antarctic<br>Expeditions</span></a><div class="flyout-navigation" style="display: none;"><div class="t"></div><div class="m clear"><ul><li><a href="http://www.quarkexpeditions.com/antarctic-expeditions/antarctic-explorer/overview">Antarctic Explorer</a><p>11 or 12 day vacations that include highlights of the Antarctic Peninsula...</p></li><li><a href="http://www.quarkexpeditions.com/antarctic-expeditions/antarctica-s-far-east/overview">Antarctica's Far East</a><p>A 31-day End of an Era Antarctic expedition saluting Douglas Mawson...</p></li><li><a href="http://www.quarkexpeditions.com/antarctic-expeditions/antarctica-fly-and-cruise/overview">Antarctica Flights</a><p>8-day Antarctic Peninsula cruise with flights across the Drake...</p></li><li><a class="active" href="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/overview">Crossing the Circle</a><p>15-day expedition cruise across the Antarctic Circle....</p></li><li><a href="http://www.quarkexpeditions.com/antarctic-expeditions/epic-antarctica/overview">Epic Antarctica</a><p>A 32-day semi-circumnavigation of Antarctica - End of an Era...</p></li><li><a href="http://www.quarkexpeditions.com/antarctic-expeditions/explorers-quest/overview">Explorers' Quest</a><p>20-day cruise to South Georgia, Falklands (Malvinas) &amp; the Peninsula...</p></li><li><a href="http://www.quarkexpeditions.com/antarctic-expeditions/ross-sea-centennial-voyage/overview">Ross Sea</a><p>A 29-day End of an Era cruise marking the centennial of Amundsen...</p></li><li><a href="http://www.quarkexpeditions.com/antarctic-expeditions/weddell-sea-south-georgia/overview">Weddell Sea</a><p>A 31-day expedition to the Weddell Sea and South Georgia...</p></li><li><a href="http://www.quarkexpeditions.com/node/1634">Holiday Flights to Ushuaia</a><p>Holiday Flights from Buenos Aires to Ushuaia and Back...</p></li></ul></div><div class="b"></div></div></li><li class="has-flyout"><a href="http://www.quarkexpeditions.com/arctic-expeditions" class=""><span>Arctic<br>Expeditions</span></a><div class="flyout-navigation" style="display: none;"><div class="t"></div><div class="m clear"><ul><li class=""><a href="http://www.quarkexpeditions.com/arctic-expeditions/arctic-circumnavigation/overview">Arctic Circumnavigation</a><p>An End of an Era, 66-day tour of the Arctic epic vacation...</p></li><li><a href="http://www.quarkexpeditions.com/arctic-expeditions/arctic-passage/overview">Arctic Passage</a><p>Khlebnikov's final transit of the Northwest Passage - 23 days...</p></li><li><a href="http://www.quarkexpeditions.com/arctic-expeditions/greenland-semi-circumnavigation/overview">Greenland Semi-circumnavigation</a><p>21-days along the Greenland coast....</p></li><li><a href="http://www.quarkexpeditions.com/arctic-expeditions/introduction-spitsbergen/overview">Introduction to Spitsbergen</a><p>8-day getaway delivers the thrills in the shortest amount of time...</p></li><li><a href="http://www.quarkexpeditions.com/arctic-expeditions/north-pole-20th-anniversary-expedition/overview">North Pole</a><p>15-day 20th anniversary adventure to 90 N aboard 50 Years of Victory...</p></li><li><a href="http://www.quarkexpeditions.com/arctic-expeditions/northeast-passage-20th-anniversary-cruise/overview">Northeast Passage</a><p>A 28-day voyage through the Russian Arctic...</p></li><li><a href="http://www.quarkexpeditions.com/arctic-expeditions/spitsbergen-explorer/overview">Spitsbergen Explorer</a><p>Choose this 11-day Spitsbergen to experience everything Arctic...</p></li><li><a href="http://www.quarkexpeditions.com/arctic-expeditions/iceland-eastern-greenland-spitsbergen/overview">Iceland, Eastern Greenland, Spitsbergen</a><p>14-days, 3 countries with sea-kayaking...</p></li><li><a href="http://www.quarkexpeditions.com/arctic-expeditions/spitsbergen-depth/overview">Spitsbergen in Depth</a><p>A 14-day adventure circumnavigating the big island....</p></li></ul></div><div class="b"></div></div></li><li class="has-flyout"><a href="http://www.quarkexpeditions.com/special-interest-voyages"><span>Special Interest<br>Voyages</span></a><div class="flyout-navigation" style="display: none;"><div class="t"></div><div class="m clear"><ul><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/celebrity-guests">Celebrity Guests</a><p>Let a celebrity travel with you, learn how...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/cruises-photographers">Photo Cruises</a><p>Shoot, sail and learn with fellow photographers....</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/20th-anniversary">20th Anniversary Cruises</a><p>20th Anniversary Voyages - North Pole and Northeast Passage...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/birding">Birding</a><p>The Arctic and Antarctica are paradises for birders...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/camping">Camping</a><p>Set up a tent on the ice under the midnight sun....</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/celebration-cruise-travel">Celebrate</a><p>Celebration Cruise Travel...</p></li><li><a href="http://www.quarkexpeditions.com/greenland">Greenland</a><p>Quark Expeditions cruises to Greenland's fjords four times in 2011...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/reunions-get-togethers-we-welcome-groups">Groups</a><p>Reunions, Get-togethers - We welcome groups!...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/sea-kayaking">Kayaking</a><p>Sea-kayak in polar waters around icebergs and past wildlife...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/mountaineering">Mountaineering</a><p>Climb mountains and ice surfaces in the high latitudes...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/one-kind-cruises">One of a Kind</a><p>Polar cruises that will never be repeated...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/penguin-lovers">Penguin Lovers</a><p>If you can't get enough of penguins, these are the cruises for you...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/polar-history">Polar History</a><p>Follow in the wake of polar explorers on these expeditions...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/remote-islands">Remote Islands</a><p>These islands are almost impossible to reach they're so far away...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/cross-country-skiing-antarctica">Skiing</a><p>Cross-country ski in Antarctica where there are no trails...</p></li><li><a href="http://www.quarkexpeditions.com/special-interest-voyages/watching-whales">Whale-watching</a><p>See the gentle giants feed and play...</p></li></ul></div><div class="b"></div></div></li><li class="has-flyout"><a href="http://www.quarkexpeditions.com/our-ships"><span>Our Ships</span></a><div class="flyout-navigation" style="display: none;"><div class="t"></div><div class="m clear"><ul><li><a href="http://www.quarkexpeditions.com/our-ships/50-years-of-victory">50 Years of Victory</a><p>128 guests, nuclear-powered icebreaker, the largest in the world...</p></li><li><a href="http://www.quarkexpeditions.com/our-ships/akademik-ioffe">Akademik Ioffe</a><p>107 guests, nimble and stable, with a variety of cabin configurations...</p></li><li><a href="http://www.quarkexpeditions.com/our-ships/akademik-sergey-vavilov">Akademik Sergey Vavilov</a><p>107 guests, panoramic observation lounge, nimble and stable...</p></li><li><a href="http://www.quarkexpeditions.com/our-ships/clipper-adventurer">Clipper Adventurer</a><p>122 guests, elegant, sophisticated expedition vessel....</p></li><li><a href="http://www.quarkexpeditions.com/our-ships/kapitan-khlebnikov">Kapitan Khlebnikov</a><p>112 guests, legendary, polar-class icebreaker, marking the End of an Era ...</p></li><li><a href="http://www.quarkexpeditions.com/our-ships/ocean-nova">Ocean Nova</a><p>73 guests, Scandinavian styling, ice strengthened hull...</p></li><li><a href="http://www.quarkexpeditions.com/our-ships/sea-spirit-quarks-first-luxurious-vessel">Sea Spirit</a><p>Our luxurious vessel with king beds in roomy cabins, some with balconies....</p></li><li><a href="http://www.quarkexpeditions.com/our-ships/compare-ships">Compare Ships</a><p>Compare our fleet of ice-strengthened and icebreaker vessels...</p></li></ul></div><div class="b"></div></div></li><li class="has-flyout"><a href="http://www.quarkexpeditions.com/the-polar-experience"><span>The Polar<br>Experience</span></a><div class="flyout-navigation" style="display: none;"><div class="t"></div><div class="m clear"><ul><li><a href="http://www.quarkexpeditions.com/the-antarctic-experience">Experiencing Antarctica</a><p>Penguins, icebergs, kayaking, camping, and 24 hours of daylight....</p></li><li><a href="http://www.quarkexpeditions.com/the-arctic-experience">Experiencing the Arctic</a><p>Polar bears, indigenous cultures, and icebergs...</p></li><li><a href="http://www.quarkexpeditions.com/the-expedition-experience">Expedition Experience</a><p>Expect the unexpected is the cardinal rule of expedition cruising....</p></li><li><a href="http://www.quarkexpeditions.com/the-expedition-experience/expedition-choices/arctic-antarctica">Destination Choices</a><p>Choosing between polar opposites - the Arctic and Antarctica...</p></li><li><a href="http://www.quarkexpeditions.com/the-expedition-experience/expedition-choices">Expedition Choices</a><p>After choosing your destination, then choose your style of ship...</p></li><li><a href="http://www.quarkexpeditions.com/polar-experience/adventure-options">Adventure Options</a><p>Add kayaking, camping, mountaineering or cross-country skiing....</p></li><li><a href="http://www.quarkexpeditions.com/polar-experience/e-newsletter-archive">E-Newsletter Archive</a><p>Back issues of our e-newsletter about everything Arctic and Antarctic...</p></li><li><a href="http://www.quarkexpeditions.com/polar-experience/expedition-leader-report">Expedition Leader Report</a><p>Expedition Leader Jan Bryde reports from the North Pole....</p></li><li><a href="http://www.quarkexpeditions.com/polar-experience/rare-expeditions-2011">Rare Expeditions in 2011</a><p>1991-2011 - We are celebrating our 20th anniversary...</p></li><li><a href="http://www.quarkexpeditions.com/polar-experience/suggested-reading">Suggested Reading</a><p>Polar adventure books to read before or after your journey...</p></li><li><a href="http://www.quarkexpeditions.com/polar-experience/essential-extras">Essential Extras</a><p>We book flights and package tours to complement your adventure...</p></li></ul></div><div class="b"></div></div></li><li class="has-flyout"><a href="http://www.quarkexpeditions.com/why-quark" class=""><span>Why Quark?</span></a><div class="flyout-navigation" style="display: none;"><div class="t"></div><div class="m clear"><ul><li><a href="http://www.quarkexpeditions.com/our-people">Our People</a><p>Meet our Expedition, Hospitality, Sales and Client Services Teams....</p></li><li><a href="http://www.quarkexpeditions.com/our-heritage-and-experience">Our Heritage</a><p>Since 1991, we have been the leader in polar adventures...</p></li><li><a href="http://www.quarkexpeditions.com/our-commitment-to-the-environment">Environmental Commitment</a><p>We actively work to protect and preserve the polar regions for future generations...</p></li><li><a href="http://www.quarkexpeditions.com/why-quark/our-ships">Our Ships</a><p>The cold hard facts about sailing in the polar regions...</p></li><li><a href="http://www.quarkexpeditions.com/why-quark/take-award-winning-photos">Take Award-winning Photos</a><p>Award-winning photographs from Sue Flood...</p></li><li><a href="http://www.quarkexpeditions.com/why-quark/ways-save">Ways to Save</a><p>Save hundreds or thousands off the published rates...</p></li></ul></div><div class="b"></div></div></li><li class="has-flyout"><a href="http://www.quarkexpeditions.com/share-your-adventure"><span>Share Your<br>Adventure</span></a><div class="flyout-navigation" style="display: none;"><div class="t"></div><div class="m clear"><ul><li><a href="http://www.quarkexpeditions.com/forum">Iceberg Lounge</a><p>The place to share your opinion, ask questions, and converse...</p></li><li><a href="http://www.quarkexpeditions.com/user/register">Join My Quark</a><p>Get all the benefits of a member of our online community...</p></li><li><a href="http://www.quarkexpeditions.com/share-your-adventure/quark-shares">Quark Shares</a><p>See what we have to share with you...cartoons, travelogs, blogs etc....</p></li><li><a href="http://www.quarkexpeditions.com/user/images">Share Photos &amp; Videos</a><p>Upload your favorite expedition photos and videos...</p></li><li><a href="http://www.quarkexpeditions.com/share-your-adventure/tweet-digg">Tweet, Like, Digg</a><p>Let your favorite social network know about the Arctic &amp; Antarctica...</p></li></ul></div><div class="b"></div></div></li></ul>	
        </div>	<!-- class="navigation" -->
		<div class="content">
			<div class="content-bg-bottom"><div class="content-bg-middle"><div class="content-bg-gradient clear">
        	
            <div class="breadcrumb"><h2 class="accessibility">You are here:</h2><ol class="clear"><li><a class="quarkA" href="http://www.quarkexpeditions.com/">Home</a></li><li><a class="quarkA" title="Antarctic Expeditions" href="http://www.quarkexpeditions.com/antarctic-expeditions">Antarctic Expeditions</a></li><li>Trip Log</li></ol></div>            
            <div class="main-content">
            	            	<div class="box-tabs">
            		<div class="tabs clear"><ul>
<li class=""><a class="" href="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/overview"><span>Overview</span></a></li>
<li class=""><a class="" href="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/itinerary"><span>Itinerary</span></a></li>
<li class=""><a class="" href="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/dates-rates"><span>Dates &amp; Rates</span></a></li>
<li class=""><a class="" href="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/ship-information"><span>Ship Information</span></a></li>
<li class=""><a class="" href="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle-southern-expedition/photos-videos"><span>Photos &amp; Videos</span></a></li>
<li class="first"><strong><a class="active active" href="/circle.php"><span>Trip Log</span></a></strong></li>
<li class=""><a class="" href="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/trip-extras"><span>Essential Extras</span></a></li>
</ul></div>
 
	           		<div class="tab-content">
            			<div class="with-price-title">
			<h1>
                Crossing the Circle: Southern Expedition<br>February, 2009
            </h1>
</div> 
	<div id="map" style="width: 550px; height: 500px; border-style:solid; margin-bottom:15px; margin-top:10px; margin-left:40px"></div>
	
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





            			
                	<p class="back-to-top clear"><a class="button button-up-arrow-dark-brown" href="#"><span>Back to Top</span></a></p>
                </div>
              </div>
            </div><!-- End main-content -->
            <div class="additional-content">
            	<div class="box-2">
	
	<div class="box-2-tl"></div>
	<div class="box-2-m">
		<div class="next-steps">
	  	<h2>Next Steps</h2>
	    <ul>
	    	    	<li class="clear"><a class="button button-arrow" href="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/dates-rates"><span>Book Online</span></a></li>
	    			<li class="clear"><a class="button button-arrow-dark-brown" href="http://www.quarkexpeditions.com/dossier/255/USD"><span>Free Info Package</span></a></li>
			    <li class="call">Call our expedition experts on
	    	<ul class="phone-numbers">
	    		<li>1 866 961 2961</li>
	    	  <li>+1 (416) 645 8243</li>
	    	</ul>
	    	
	    	<div class="tooltip" style="z-index: 100;">
	    	<a class="arrow-link quarkA" href="#">View opening hours</a>
	    	<div style="display: none; opacity: 0;" class="tooltip-bottom"><div class="tooltip-top clear"><div class="padding clear"><a style="display: none;" class="close" href="#">close</a><div class="tt_content"><h3>Opening Times</h3><p>Our Polar Adventure Advisors are available Monday-Friday 9am-5pm EDT.</p></div></div></div></div></div>
			
		
	    </li>
	    	    <li class="clear"><a class="button button-arrow-dark-brown" href="http://www.quarkexpeditions.com/contact-us/inquiry-form"><span>Contact Us</span></a></li>
	    <li class="clear"><a class="button button-arrow-dark-brown" href="http://www.quarkexpeditions.com/send-page?nid=255"><span>Email this page</span></a></li>
	    <li class="clear"><a class="button button-arrow-dark-brown" href="http://api.addthis.com/oexchange/0.8/offer?url=http://www.safety3rdblog.com/circle.php&amp;title=Crossing+the+Circle&amp;username=quarkexpeditions"><span>Bookmark this page</span></a></li>
	    </ul>
		</div>
	</div>
	<div class="box-2-bl"></div>
</div><!-- End box-2 -->


<h2>
Reviews for this expedition</h2>
<ul class="expeditions"><li class="box-3"><div class="box-3-t"><div class="box-3-tr"></div></div><div class="box-3-m clear"><h2 class="review-stars"><div title="Very good - we'll be recommending you to our friends!" class="review-grey-stars review-4">Very good - we'll be recommending you to our friends!</div></h2><blockquote><p>"The night with the perfect light, cruising through channels;
Nesting penguins and the iceberg graveyard."</p></blockquote><p class="more"><a rel="30" class="inline_review quarkA" href="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/reviews?complete=30#r30">Read full review</a></p></div><div class="box-3-b"><div class="box-3-br"></div></div><p class="reviewer">Srikant Balan, January 2010</p></li><li class="box-3"><div class="box-3-t"><div class="box-3-tr"></div></div><div class="box-3-m clear"><h2 class="review-stars"><div title="Excellent - the trip of a lifetime!" class="review-grey-stars review-5">Excellent - the trip of a lifetime!</div></h2><blockquote><p>"It was an extraordinary opportunity to visit places under the polar circle, places seldom seen by human beings. A close experience with Nature in the last virgin place on planet Earth."</p></blockquote><p class="more"><a rel="106" class="inline_review quarkA" href="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/reviews?complete=106#r106">Read full review</a></p></div><div class="box-3-b"><div class="box-3-br"></div></div><p class="reviewer">Juan Abal, February 2010</p></li></ul>            </div><!-- End additional-content -->

          		<div class="stay-in-touch-share-subscribe clear">
	
<h2>Stay in touch</h2>
<form class="stay-in-touch clear" id="email-signup-marketing" method="post" accept-charset="UTF-8" action="http://www.quarkexpeditions.com/antarctic-expeditions/crossing-circle/overview">
 <input type="text" class="form-text text rounded-text" value="Enter email" id="edit-email" name="email" maxlength="128">
<input type="hidden" value="form-94f4978ef5f59fb9110dbf8581a3789d" id="form-94f4978ef5f59fb9110dbf8581a3789d" name="form_build_id">
<input type="hidden" value="email_signup_marketing" id="edit-email-signup-marketing" name="form_id">
<button class="button form-submit button-small" type="submit" value="Sign up" name="op"><span>Sign up</span></button>

</form>
	<div class="share-subscribe clear">
   <h2 class="accessibility">Share and Subscribe</h2>
   <ul>
     <li class="first add-this"><a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=quarkexpedition">Add this</a></li>
     <li class="facebook"><a href="http://www.facebook.com/share.php?u=http%3A%2F%2Fwww.quarkexpeditions.com%2Fantarctic-expeditions%2Fcrossing-circle%2Foverview">Share on Facebook</a></li>
		 <li class="rss"><a href="http://www.quarkexpeditions.com/blog/feed">RSS feed</a></li>
   </ul>
  </div><!-- End share-subscribe -->
</div><!-- End stay-in-touch-share-subscribe -->           </div></div></div>
		</div>	<!-- class="content" -->
		
		<div class="footer cols5 clear">
			<h2 class="accessibility">Links</h2><div class="col first"><h3>Important Information</h3><ul><li><a href="http://www.quarkexpeditions.com/terms-and-conditions">Terms and Conditions</a></li><li><a href="http://www.quarkexpeditions.com/privacy-policy">Privacy Policy</a></li><li><a href="http://www.quarkexpeditions.com/terms-use">Terms of Use</a></li></ul></div><div class="col"><h3>Travel Resources</h3><ul><li><a href="http://www.quarkexpeditions.com/travel-insurance">Travel Insurance</a></li><li><a href="http://www.quarkexpeditions.com/expedition-search">Expedition Search</a></li><li><a href="http://www.quarkexpeditions.com/agents">Agents</a></li></ul></div><div class="col"><h3>About Us</h3><ul><li><a href="http://www.quarkexpeditions.com/media-room">Media Room</a></li><li><a href="http://www.quarkexpeditions.com/photo-credits">Photo Credits</a></li><li><a href="http://www.quarkexpeditions.com/company">The Company</a></li></ul></div><div class="col"><h3>Talk to Us</h3><ul><li><a href="http://www.quarkexpeditions.com/contact-us/inquiry-form">Contact Us</a></li><li><a href="http://www.quarkexpeditions.com/talk-us/international-representatives">International Representatives</a></li><li><a href="http://www.quarkexpeditions.com/talk-us/deutsch">Deutsch</a></li><li><a href="http://www.quarkexpeditions.com/talk-us/italiano">Italiano</a></li><li><a href="http://www.quarkexpeditions.com/talk-us/portugues">Portugues</a></li><li><a href="http://www.quarkexpeditions.com/talk-us/espanol">Español</a></li><li><a href="http://www.quarkexpeditions.com/talk-us/japanese">???</a></li><li><a href="http://www.quarkexpeditions.com/talk-us/chinese">??</a></li></ul></div><div class="col"><h3>FAQs</h3><ul><li><a href="http://www.quarkexpeditions.com/faq">Answers</a></li></ul></div>
		</div>	<!-- class="footer cols5 clear" -->
	
	</div>		<!-- class="container" -->

	</div>		<!-- class="page layout-2" -->
		

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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="/ext/js/quark-menu.js"></script>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
jQuery.extend(Drupal.settings, { "basePath": "/", "omniture": { "account_code": "taquarkexpeditionsprod", "currency_code": "USD" } });
//--><!]]>
</script>

	</body>
</html>