-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: db2664.perfora.net
-- Generation Time: Apr 22, 2012 at 06:54 PM
-- Server version: 5.0.91
-- PHP Version: 5.3.3-7+squeeze8
-- 
-- Database: `db347804695`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `master_suspects`
-- 

CREATE TABLE `master_suspects` (
  `siteid` int(10) unsigned NOT NULL,
  `suspectid` int(10) unsigned NOT NULL,
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `master_suspects`
-- 

INSERT INTO `master_suspects` VALUES (1, 1, 1);
INSERT INTO `master_suspects` VALUES (1, 2, 5);
INSERT INTO `master_suspects` VALUES (1, 3, 6);
INSERT INTO `master_suspects` VALUES (1, 4, 7);
INSERT INTO `master_suspects` VALUES (2, 1, 8);
INSERT INTO `master_suspects` VALUES (3, 1, 9);
INSERT INTO `master_suspects` VALUES (4, 1, 10);
INSERT INTO `master_suspects` VALUES (4, 5, 11);
INSERT INTO `master_suspects` VALUES (5, 1, 12);
INSERT INTO `master_suspects` VALUES (5, 2, 13);
INSERT INTO `master_suspects` VALUES (5, 3, 14);
