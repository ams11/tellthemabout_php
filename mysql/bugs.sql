-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: db2664.perfora.net
-- Generation Time: Apr 22, 2012 at 08:34 PM
-- Server version: 5.0.91
-- PHP Version: 5.3.3-7+squeeze8
-- 
-- Database: `db347804695`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `bugs`
-- 

CREATE TABLE `bugs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `date` datetime NOT NULL,
  `description` text NOT NULL,
  `reported` varchar(45) default NULL,
  `comment` text,
  `type` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- 
-- Dumping data for table `bugs`
-- 

INSERT INTO `bugs` VALUES (1, '2009-12-25 00:00:00', 'The first time the page is loaded after a location update has arrived, earlier parts of the route may be missing', 'Alex', 'There''s a bug in how I retrieve the cached route line when new parts of the route are being calculated. Since it only shows up the very first time a page is loaded after a location is added (and even then not always, depending on further circumsrtances), I haven''t taken the time to fix it', 1);
INSERT INTO `bugs` VALUES (2, '2009-12-25 00:00:00', 'Next/Previous links don''t work on locations that get visited more than once in the route (e.g. Manila)', 'Alex', 'the code doesn''t yet know how to deal with a single location that needs to appear twice in the Next/Previous chain. Seems minor, so I haven''t bothered fixing', 1);
INSERT INTO `bugs` VALUES (3, '2009-12-25 00:00:00', 'certain symbols get stripped out from location updates', 'Alex', '''+'' is the example I''ve run into so far, not imortant enough to care at this point', 1);
INSERT INTO `bugs` VALUES (4, '2009-12-25 00:00:00', 'Blogger won''t let you put a comma inside of a tag (comma is used to separate tags), but the blog posts are linked to locations based on tags. Consequently, when there is a blog post for a given city, but the route contains more than once city with that name (in different states), both cities will be associated with the blog post. Example: Aurangabad, Maharashtra, India and Aurangabad, Bihar, India, seen here: http://www.safety3rdblog.com/india.php', 'Alex', 'not going to happen very frequently... I''m impressed it''s happened already', 1);
INSERT INTO `bugs` VALUES (5, '2009-12-25 00:00:00', 'Blog post length calculation is sometimes wrong', 'Alex', 'the ''Read More'' link should only show up for a blog post if its length exceeds 300 characters. However, in the ''2 days driving done'' for the India page (http://www.safety3rdblog.com/india.php) it shows up anyway because blogger embeds a tracker image at the end of each post, and I haven''t so far bothered stripping it out and am counting the characters needed for it in the length calculation, so my lenghts are always off by about 100 characters. Not planning to make any more posts of less than 200 characters though, so shouldn''t be much of an issue', 1);
INSERT INTO `bugs` VALUES (6, '2009-12-25 00:00:00', 'Blog and Photo albums tags don''t always open a marker on the map when clicked', 'Alex', 'this is actually ''By Design'', I think, for now anyway - the tags only get associated with markers created for location updates, so if a blog post gets tagged with something that hasn''t been reported as a location so far, the tag won''t link to anything. If it did, we''d have location markers that aren''t necessarily part of the route, which is something I''m not ready to deal with just now.', 1);
INSERT INTO `bugs` VALUES (7, '2010-01-07 05:21:44', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (8, '2010-01-07 17:37:17', 'When the map is first displayed, the popup for the latest post shows up in such a way that it takes the entire screen to the right. Somehow, the right boundary is getting lost. I would prefer the popup to be much smaller.', 'Koti and Kotiki', NULL, 0);
INSERT INTO `bugs` VALUES (9, '2010-01-12 06:56:32', 'Day Count can be wrong when an update is first imported from twitter', 'Alex', NULL, 0);
INSERT INTO `bugs` VALUES (10, '2011-01-10 18:22:31', 'It''s funny goodluck <a href=" http://xpornhub.multiply.com ">Pornhub\r</a>  =O ', 'Puqfpkvg', NULL, 0);
INSERT INTO `bugs` VALUES (11, '2011-01-11 15:04:50', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (12, '2011-01-11 15:27:21', 'Very interesting tale <a href=" http://maxporn.multiply.com ">Maxporn</a>  jbirv <a href=" http://xredtube.multiply.com ">Redtube\r</a>  %-[[ <a href=" http://xyouporn.multiply.com ">Youporn\r</a>  :-))) <a href=" http://xnxxx.multiply.com ">Xnxx\r</a>  vyfaff <a href=" http://xvideosx.multiply.com ">Xvideos\r</a>  euwaq ', 'Ypiualvs', NULL, 0);
INSERT INTO `bugs` VALUES (13, '2011-06-08 03:58:00', 'I4GNA5  <a href="http://luhtfcvddejf.com/">luhtfcvddejf</a>, [url=http://kzhcieabhbvl.com/]kzhcieabhbvl[/url], [link=http://biojolglmmka.com/]biojolglmmka[/link], http://kkugpsydffgp.com/', 'rbswrddjjm', NULL, 0);
INSERT INTO `bugs` VALUES (14, '2011-06-08 03:58:18', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (15, '2011-07-17 06:33:35', 'ZEwj9V  <a href="http://ihmaruojwaqm.com/">ihmaruojwaqm</a>, [url=http://ebuoexwnlxbh.com/]ebuoexwnlxbh[/url], [link=http://ahoocrxdcrwy.com/]ahoocrxdcrwy[/link], http://hxiwugsbcidk.com/', 'vgwuljxosoi', NULL, 0);
INSERT INTO `bugs` VALUES (16, '2011-07-17 06:33:38', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (17, '2011-08-20 01:17:44', 'QMtcXh  <a href="http://lrmuadejexjh.com/">lrmuadejexjh</a>, [url=http://idqqadhblnmz.com/]idqqadhblnmz[/url], [link=http://sqbjqxkfhdlo.com/]sqbjqxkfhdlo[/link], http://twgvzzbtrvwv.com/', 'ahovqumeocm', NULL, 0);
INSERT INTO `bugs` VALUES (18, '2011-08-20 01:17:44', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (19, '2011-08-25 14:05:28', 'kRaVq4  <a href="http://ncvlouzjnnwp.com/">ncvlouzjnnwp</a>, [url=http://gprldpokumqm.com/]gprldpokumqm[/url], [link=http://ucvnvzfgopkr.com/]ucvnvzfgopkr[/link], http://btyixrwnfxlx.com/', 'opygnmatj', NULL, 0);
INSERT INTO `bugs` VALUES (20, '2011-08-25 14:05:29', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (21, '2011-09-14 06:54:57', '17JIGR  <a href="http://zvtdttowkehd.com/">zvtdttowkehd</a>, [url=http://nyldrdbxuxhr.com/]nyldrdbxuxhr[/url], [link=http://dcemgsafrsrc.com/]dcemgsafrsrc[/link], http://secfmssjthiq.com/', 'szevfh', NULL, 0);
INSERT INTO `bugs` VALUES (22, '2011-09-14 06:54:59', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (23, '2011-09-21 08:01:23', 'fJWFHU  <a href="http://ogodelhogfbe.com/">ogodelhogfbe</a>, [url=http://zsfvyevkevmb.com/]zsfvyevkevmb[/url], [link=http://guffwwptibhi.com/]guffwwptibhi[/link], http://eunffqwujqpj.com/', 'cqydtxwvyyx', NULL, 0);
INSERT INTO `bugs` VALUES (24, '2011-09-21 08:01:26', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (25, '2011-11-06 19:17:31', 'gJ4PNr  <a href="http://folubtowkwpz.com/">folubtowkwpz</a>, [url=http://ssnreyrqdglw.com/]ssnreyrqdglw[/url], [link=http://nvalyqiwkhwg.com/]nvalyqiwkhwg[/link], http://ybqfgubuokmg.com/', 'vccqxnaeelp', NULL, 0);
INSERT INTO `bugs` VALUES (26, '2011-11-06 19:17:32', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (27, '2011-11-26 01:22:22', 'GPX4Ng  <a href="http://dwsdruseonxh.com/">dwsdruseonxh</a>, [url=http://mlnxkknqurka.com/]mlnxkknqurka[/url], [link=http://jwotbvwbnntb.com/]jwotbvwbnntb[/link], http://wwbhbfoonwfr.com/', 'gnaxfxxa', NULL, 0);
INSERT INTO `bugs` VALUES (28, '2011-11-26 01:22:23', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (29, '2012-02-20 09:48:24', '', '', NULL, 0);
INSERT INTO `bugs` VALUES (30, '2012-03-04 00:58:26', 'kBUX47  <a href="http://kooygixvqgqh.com/">kooygixvqgqh</a>, [url=http://sbrqhgwwnyxd.com/]sbrqhgwwnyxd[/url], [link=http://iieltkhqdlmk.com/]iieltkhqdlmk[/link], http://arlkszndslxd.com/', 'xvfthxshlz', NULL, 0);
INSERT INTO `bugs` VALUES (31, '2012-03-04 00:58:27', '', '', NULL, 0);
