-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: db2664.perfora.net
-- Generation Time: Apr 22, 2012 at 08:32 PM
-- Server version: 5.0.91
-- PHP Version: 5.3.3-7+squeeze8
-- 
-- Database: `db347804695`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `layout`
-- 

CREATE TABLE `layout` (
  `siteid` int(10) unsigned NOT NULL auto_increment,
  `bgcolor` varchar(45) default NULL,
  `bgimg` text,
  `img1url` text,
  `img1height` varchar(32) default NULL,
  `img1title` text,
  `img2url` text,
  `img2height` varchar(32) default NULL,
  `img2title` text,
  `imgcaption` text,
  `bgimginner` text,
  PRIMARY KEY  (`siteid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `layout`
-- 

INSERT INTO `layout` VALUES (1, '#0d4f4c', 'url(/img/layout/BGRR.jpg)', '/img/layout/tajmahal.jpg', '136px', 'The Majestic Taj Mahal at sunrise in Agra, Uttar Pradesh, India', '/img/layout/rickshaws.jpg', '136px', 'The Rickshaws on the Beach in Kerala, India', 'Safety Third!', '/img/layout/india-map.jpg');
INSERT INTO `layout` VALUES (2, '#201212', 'url(/img/layout/bg.jpg)', '/img/layout/bridge.jpg', '137px', 'Young monks strolling along U Bein''s Bridge in Amarapura, Burma', '/img/layout/lhasa.jpg', '137px', 'The Potala Palaca - ancient home of the Dalai Lama, Lhasa, Tibet', 'Tibet: the Roof of the World', '/img/layout/tibetburma.jpg');
INSERT INTO `layout` VALUES (3, '#201212', 'url(/img/layout/bg.jpg)', '/img/layout/pyramids.jpg', '153px', 'The Pyramids of Giza - Cairo, Egypt, Africa', '/img/layout/inegypt.jpg', '141px', 'The World Wide adventure reaches Cairo and continent #7', 'Africa reached on May 30, 2010', '/img/layout/nafrica.jpg');
INSERT INTO `layout` VALUES (4, '#6E6D72', 'url(/img/layout/bgice.jpg)', '/img/layout/sunset.jpg', '133px', 'Golden sunset over the Errara Channel in Antarctica', '/img/layout/calving.jpg', '133px', 'Majestic Ice sheets in Neko Harbor, Antarctica', 'Beyond the Southern Circle, lies Antarctica', '/img/layout/antarctica.jpg');
INSERT INTO `layout` VALUES (5, '#201212', 'url(/img/layout/bg.jpg)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
