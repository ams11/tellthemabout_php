-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: db2664.perfora.net
-- Generation Time: Apr 22, 2012 at 06:56 PM
-- Server version: 5.0.91
-- PHP Version: 5.3.3-7+squeeze8
-- 
-- Database: `db347804695`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `suspects`
-- 

CREATE TABLE `suspects` (
  `name` varchar(100) NOT NULL,
  `url` text,
  `icon` text NOT NULL,
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `suspects`
-- 

INSERT INTO `suspects` VALUES ('Alex Slepak', 'http://www.facebook.com/profile.php?id=1046387715', '/img/menu/alex.jpg', 1);
INSERT INTO `suspects` VALUES ('Cyrus Gray', NULL, '/img/menu/cyrus.jpg', 2);
INSERT INTO `suspects` VALUES ('Dave Lott', 'http://www.facebook.com/david.t.lott', '/img/menu/lott.jpg', 3);
INSERT INTO `suspects` VALUES ('David Logan', 'http://www.facebook.com/profile.php?id=1305102', '/img/menu/logan.jpg', 4);
INSERT INTO `suspects` VALUES ('Oliver Lee', NULL, '/img/menu/oliver.jpg', 5);
