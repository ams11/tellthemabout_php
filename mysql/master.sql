-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: db2664.perfora.net
-- Generation Time: Apr 22, 2012 at 06:53 PM
-- Server version: 5.0.91
-- PHP Version: 5.3.3-7+squeeze8
-- 
-- Database: `db347804695`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `master`
-- 

CREATE TABLE `master` (
  `title` text NOT NULL,
  `blogupdate` varchar(64) NOT NULL,
  `twitterlastid` bigint(20) unsigned default NULL,
  `fbupdate` datetime default NULL,
  `timezone` varchar(64) NOT NULL,
  `feed` text,
  `siteid` int(10) unsigned NOT NULL,
  `center` varchar(16) default NULL,
  `label` text NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime default NULL,
  `twitteruser` varchar(64) default NULL,
  `menulabel` text NOT NULL,
  `description` text NOT NULL,
  `icon` text NOT NULL,
  `menuorder` int(6) unsigned NOT NULL,
  `twitterlastdate` datetime default NULL,
  PRIMARY KEY  (`siteid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `master`
-- 

INSERT INTO `master` VALUES ('Team Website - Safety Third!', '2008-01-31T18:00:00.000-08:00', 7472972928, NULL, 'GMT', 'http://safety3rd.blogspot.com/feeds/posts/default', 1, '50.12,-122.96', 'Rickshaw Run', '2007-12-31 00:00:00', '2008-01-22 00:00:00', 'aslepak', 'The Rickshaw Run', '5,000km across India and Nepal in an infernal beast, locally referred to as a tuk-tuk!', '/img/menu/rr.jpg', 3, '2008-01-22 00:00:00');
INSERT INTO `master` VALUES ('more traveling across seven continents', '2010-11-26T00:02:00.000-08:00', 23965494375, NULL, 'GMT', 'http://safety3rd.blogspot.com/feeds/posts/default', 2, '47.61,-122.33', 'Safety Third!', '2009-11-26 00:00:00', '2010-03-18 00:00:00', 'aslepak', 'Burma & Tibet', 'Around the world in 3 months, from New Year''s Eve in Thailand to the Lebowski Fest in Iceland', '/img/menu/burma.jpg', 1, '2010-03-18 00:00:00');
INSERT INTO `master` VALUES ('Africa Awaits', '2010-11-14T00:02:00.000-08:00', 23965494375, NULL, 'GMT', 'http://safety3rd.blogspot.com/feeds/posts/default', 3, '47.61,-122.33', 'Safety Third!', '2010-04-29 00:00:00', '2010-09-09 00:00:00', 'aslepak', 'Africa Awaits!', 'Time for the 7th continent! And Israel, and Petra, and Sicily, and Mt. Rushmore, and Burning Man...', '/img/menu/egypt.jpg', 0, '2010-09-09 00:00:00');
INSERT INTO `master` VALUES ('Antarctic Circle Expedition Trip Log | Quark Expeditions', '2010-05-05T09:44:00.000-07:00', 13269063775, NULL, 'GMT', 'http://akademikioffe.blogspot.com/feeds/posts/default', 4, '-54.79,-68.23', 'Akademik Ioffe', '2009-02-02 00:00:00', '2009-02-16 00:00:00', 'myblogtest', 'Crossing the Circle', 'Two weeks in Antarctica with penguins, whales, and seals - aboard the Akademik Ioffe', '/img/menu/iceberg.jpg', 2, '2009-02-16 00:00:00');
INSERT INTO `master` VALUES ('Mongol Rally 2008', '0000-00-00 00:00:00', NULL, NULL, 'GMT', NULL, 5, NULL, 'Safety Third', '2008-07-20 00:00:00', '2008-11-09 00:00:00', NULL, 'Beyond Mongol Rally', 'Intrepid mini goes from London to Mongolia, defeats the Mongol hordes, escapes to Japan!', '/img/menu/mini.jpg', 4, '2008-11-09 00:00:00');
