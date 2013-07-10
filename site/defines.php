<?php

define('QUERY_MASTER', 'SELECT * FROM master WHERE siteid=__SITEID__;');
define('QUERY_POSTS', 'SELECT * FROM rr2008_msgs r WHERE siteid=__SITEID__ order by date desc, id desc;');
define('QUERY_PICS', 'SELECT * FROM photos WHERE id=__PHOTOID__;');
define('QUERY_ALBUMS', 'SELECT title, icon, description, url from rr2008_msgs where type=2 and siteid=__SITEID__ order by date desc LIMIT 8;');
define('QUERY_ALL_ALBUMS', 'SELECT * FROM rr2008_msgs where type=2 order by date desc, id desc;');
define('QUERY_TRIPS', 'SELECT siteid, startdate, enddate, menulabel, description, icon, timezone from master ORDER BY menuorder;');
define('QUERY_TRIP', 'SELECT startdate, enddate, menulabel from master where siteid=__SITEID__');
define('QUERY_LAYOUT', 'SELECT * from layout where siteid=__SITEID__');
define('QUERY_CSS', 'SELECT bgcolor, bgimg, bgimginner from layout where siteid=__SITEID__');
define('QUERY_TITLE', 'SELECT title from master where siteid=__SITEID__');
define('QUERY_POINTS', 'SELECT * FROM points where siteid=__SITEID__');
define('QUERY_SUSPECTS2', 'SELECT * FROM suspects where id in (SELECT suspectid FROM master_suspects WHERE siteid=__SITEID__)');
define('QUERY_SUSPECTS', 'SELECT suspectid FROM master_suspects where siteid=__SITEID__');
define('QUERY_SUSPECT', 'SELECT * from suspects where id=__SUSPECTID__');
define('QUERY_SITES', 'SELECT menulabel FROM master WHERE siteid in (SELECT siteid FROM master_suspects WHERE suspectid=__SUSPECTID__) ORDER BY menuorder ASC');
define('QUERY_POSTSTOP5', 'SELECT title, date, url from rr2008_msgs where type=1 and siteid=__SITEID__ order by date desc LIMIT 4;');
define('QUERY_BLOG_PHOTOS', 'SELECT title, icon, description, url from rr2008_msgs where type=2 and siteid=0 order by date DESC;');

define('WIDTH', '675px');
define('DEFAULT_SITEID', 3);

?>