-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: db2664.perfora.net
-- Generation Time: Apr 22, 2012 at 06:51 PM
-- Server version: 5.0.91
-- PHP Version: 5.3.3-7+squeeze8
-- 
-- Database: `db347804695`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `loccodes`
-- 

CREATE TABLE `loccodes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `abbr` varchar(10) NOT NULL,
  `name` text NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  PRIMARY KEY  (`id`,`abbr`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

-- 
-- Dumping data for table `loccodes`
-- 

INSERT INTO `loccodes` VALUES (1, 'USA.WA.SEA', 'Seattle, WA, USA', 47.6062, -122.332);
INSERT INTO `loccodes` VALUES (2, 'USA.NY.NYC', 'New York, NY, USA', 40.7143, -74.006);
INSERT INTO `loccodes` VALUES (3, 'USA.CA.SAN', 'San Diego, CA, USA', 32.7153, -117.157);
INSERT INTO `loccodes` VALUES (4, 'USA.CA.LAX', 'Los Angeles, CA, USA', 34.0522, -118.244);
INSERT INTO `loccodes` VALUES (5, 'JAP.NRT', 'Narita, Japan', 35.7766, 140.319);
INSERT INTO `loccodes` VALUES (6, 'JAP.TKO', 'Tokyo, Japan', 35.6895, 139.692);
INSERT INTO `loccodes` VALUES (7, 'JAP.NAG', 'Nagoya, Japan', 35.1814, 136.906);
INSERT INTO `loccodes` VALUES (8, 'JAP.KAN', 'Kansai Airport, Japan', 34.4429, 135.249);
INSERT INTO `loccodes` VALUES (9, 'PHP.MAN', 'Manila, Philippines', 14.62, 120.985);
INSERT INTO `loccodes` VALUES (10, 'PHP.CEB', 'Cebu City, Philippines', 10.3647, 123.905);
INSERT INTO `loccodes` VALUES (11, 'PHP.BCY', 'Borocay Island, Philippines', 11.99, 121.923);
INSERT INTO `loccodes` VALUES (12, 'HKG.HKG', 'Hong Kong, Hong Kong', 22.3964, 114.109);
INSERT INTO `loccodes` VALUES (13, 'THL.HKT', 'Phuket City, Thailand', 8.11871, 98.3107);
INSERT INTO `loccodes` VALUES (14, 'THL.PHG', 'Koh Phangan, Thailand', 9.80853, 100.029);
INSERT INTO `loccodes` VALUES (15, 'THL.BKK', 'Bangkok, Thailand', 13.8967, 100.544);
INSERT INTO `loccodes` VALUES (16, 'MYN.YNG', 'Yangon, Burma', 16.8262, 96.1736);
INSERT INTO `loccodes` VALUES (17, 'MYN.MAN', 'Manadalay, Burma', 21.8462, 96.1688);
INSERT INTO `loccodes` VALUES (18, 'MYN.BAG', 'Bagan, Burma', 21.3411, 95.4909);
INSERT INTO `loccodes` VALUES (19, 'CHN.KMG', 'Kunming, China', 25.1179, 102.756);
INSERT INTO `loccodes` VALUES (20, 'CHN.CDU', 'Chengdu, China', 30.7353, 104.098);
INSERT INTO `loccodes` VALUES (21, 'CHN.XIA', 'Xi''an, China', 34.4126, 109.012);
INSERT INTO `loccodes` VALUES (22, 'CHN.LJN', 'Lijiang, China', 26.8768, 100.23);
INSERT INTO `loccodes` VALUES (23, 'CHN.NJN', 'Nanjing, China', 32.0584, 118.796);
INSERT INTO `loccodes` VALUES (24, 'CHN.SGH', 'Shanghai, China', 31.2307, 121.473);
INSERT INTO `loccodes` VALUES (25, 'CHN.SZN', 'Shenzhen, China', 22.5434, 114.058);
INSERT INTO `loccodes` VALUES (26, 'CHN.LHA', 'Lhasa, Tibet', 29.6456, 91.1409);
INSERT INTO `loccodes` VALUES (27, 'QAT.DOH', 'Doha, Qatar', 25.2819, 51.5175);
INSERT INTO `loccodes` VALUES (28, 'ENG.LON', 'London, England', 51.5002, -0.126236);
INSERT INTO `loccodes` VALUES (29, 'ENG.STO', 'Stonehenge, England', 51.1791, -1.82631);
INSERT INTO `loccodes` VALUES (30, 'ENG.CNT', 'Canterbury, England', 51.3083, 1.09726);
INSERT INTO `loccodes` VALUES (31, 'SCT.EDN', 'Edinburgh, Scotland', 56.0061, -3.15376);
INSERT INTO `loccodes` VALUES (32, 'ENG.MAN', 'Manchester, England', 53.5103, -2.21752);
INSERT INTO `loccodes` VALUES (33, 'ENG.BST', 'Bristol, England', 51.4863, -2.57492);
INSERT INTO `loccodes` VALUES (34, 'ICE.KEF', 'Keflavik, Iceland', 64.0174, -22.5637);
INSERT INTO `loccodes` VALUES (35, 'ICE.RKJ', 'Reykjavik, Iceland', 64.157, -21.8782);
INSERT INTO `loccodes` VALUES (36, 'JAP.TOK', 'Tokyo, Japan', 35.6895, 139.692);
INSERT INTO `loccodes` VALUES (37, 'PHP.PPC', 'Puerto Princessa, Philippines', 9.9288, 118.813);
INSERT INTO `loccodes` VALUES (38, 'PHP.SBN', 'Sabang, Philippines', 10.214, 118.928);
INSERT INTO `loccodes` VALUES (39, 'PHP.TBB', 'Tubbataha Reef National Marine Park, Philippines', 8.9139, 119.917);
INSERT INTO `loccodes` VALUES (40, 'PHP.CRN', 'Coron, Philippines', 12.0689, 120.251);
INSERT INTO `loccodes` VALUES (41, 'SIR.PPC', 'Puerto Princessa, Philippines', 9.9288, 118.813);
INSERT INTO `loccodes` VALUES (42, 'THL.SAM', 'Koh Samui, Thailand', 9.512, 100.014);
INSERT INTO `loccodes` VALUES (43, 'THL.TAO', 'Koh Tao, Thailand', 10.0956, 99.8404);
INSERT INTO `loccodes` VALUES (44, 'THL.CHM', 'Chumphon, Thailand', 10.578, 99.1014);
INSERT INTO `loccodes` VALUES (45, 'THL.KHL', 'Khao Lak, Thailand', 8.6298, 98.2445);
INSERT INTO `loccodes` VALUES (46, 'THL.RNG', 'Ranong, Thailand', 10.0113, 98.7041);
INSERT INTO `loccodes` VALUES (47, 'THL.SIM', 'Similan Islands National Park, Thailand', 8.6417, 97.6358);
INSERT INTO `loccodes` VALUES (48, 'THL.RIC', 'Richelieu Rock, Thailand', 9.3976, 98.075);
INSERT INTO `loccodes` VALUES (49, 'THL.STH', 'Surat Thani, Thailand', 8.9034, 99.0129);
INSERT INTO `loccodes` VALUES (50, 'MYN.AVA', 'Inwa, Burma', 21.7811, 95.9768);
INSERT INTO `loccodes` VALUES (51, 'HUN.BUD', 'Budapest, Hungary', 47.5, 19.08);
INSERT INTO `loccodes` VALUES (53, 'SRB.BEG', 'Belgrade, Serbia', 44.8667, 20.5333);
INSERT INTO `loccodes` VALUES (54, 'BUL.SOF', 'Sofia, Bulgaria', 42.6667, 23.3333);
INSERT INTO `loccodes` VALUES (55, 'GRC.SER', 'Serres, Greece', 41.0883, 23.5428);
INSERT INTO `loccodes` VALUES (56, 'GRC.SKG', 'Thessaloniki, Greece', 40.6394, 22.9446);
INSERT INTO `loccodes` VALUES (57, 'GRC.ATH', 'Athens, Greece', 37.9667, 23.7167);
INSERT INTO `loccodes` VALUES (58, 'ISR.TLV', 'Tel Aviv, Israel', 32.0662, 34.7778);
INSERT INTO `loccodes` VALUES (59, 'MAC.SKP', 'Skopje, Macedonia', 42, 21.4333);
INSERT INTO `loccodes` VALUES (60, 'ISR.HFA', 'Haifa, Israel', 32.8304, 34.9743);
INSERT INTO `loccodes` VALUES (61, 'ISR.JRS', 'Jerusalem, Israel', 31.7683, 35.2137);
INSERT INTO `loccodes` VALUES (62, 'PST.BTH', 'Bethlehem, Palestinian Territories', 31.7058, 35.2027);
INSERT INTO `loccodes` VALUES (63, 'ISR.ETH', 'Eilat, Israel', 29.5577, 34.9519);
INSERT INTO `loccodes` VALUES (64, 'JRD.PTR', 'Petra, Jordan', 30.4132, 35.4762);
INSERT INTO `loccodes` VALUES (65, 'JRD.WMU', 'Wadi Musa, Jordan', 30.3161, 35.4856);
INSERT INTO `loccodes` VALUES (66, 'JRD.AQJ', 'Aqaba, Jordan', 29.5425, 35.0103);
INSERT INTO `loccodes` VALUES (67, 'JRD.AMM', 'Amman, Jordan', 31.9576, 35.9456);
INSERT INTO `loccodes` VALUES (68, 'EGP.DAH', 'Dahab, Egypt', 28.501, 34.5134);
INSERT INTO `loccodes` VALUES (69, 'EGP.SSH', 'Sharm el-Sheikh, Egypt', 27.8598, 34.2824);
INSERT INTO `loccodes` VALUES (70, 'EGP.SIN', 'Mt. Sinai, Egypt', 28.5396, 33.9733);
INSERT INTO `loccodes` VALUES (71, 'EGP.CAI', 'Cairo, Egypt', 30.0333, 31.35);
INSERT INTO `loccodes` VALUES (72, 'EGP.ALY', 'Alexandria, Egypt', 31.2135, 29.9443);
INSERT INTO `loccodes` VALUES (73, 'EGP.LXR', 'Luxor, Egypt', 25.7006, 32.6392);
INSERT INTO `loccodes` VALUES (74, 'EGP.ASW', 'Aswan, Egypt', 24.0818, 32.9108);
INSERT INTO `loccodes` VALUES (75, 'TUN.TUN', 'Tunis, Tunisia', 36.8188, 10.166);
INSERT INTO `loccodes` VALUES (76, 'ITL.PMO', 'Palermo, Italy', 38.1156, 13.3614);
INSERT INTO `loccodes` VALUES (77, 'ITL.TPS', 'Trapani, Italy', 38.0186, 12.5146);
INSERT INTO `loccodes` VALUES (78, 'ITL.STR', 'Isola Stromboli, Italy', 38.7893, 15.2136);
INSERT INTO `loccodes` VALUES (79, 'ITL.NAP', 'Naples, Italy', 40.8333, 14.25);
INSERT INTO `loccodes` VALUES (80, 'ITL.ROM', 'Roma, Italy', 41.9, 12.45);
INSERT INTO `loccodes` VALUES (81, 'ITL.PSA', 'Pisa, Italy', 43.7161, 10.3966);
INSERT INTO `loccodes` VALUES (82, 'SWS.GVA', 'Geneva, Switzerland', 46.2038, 6.14);
INSERT INTO `loccodes` VALUES (83, 'FRA.PAR', 'Paris, France', 48.8, 2.3333);
INSERT INTO `loccodes` VALUES (84, 'IRE.ORK', 'Cork, Ireland', 51.8979, -8.4711);
INSERT INTO `loccodes` VALUES (85, 'IRE.DUB', 'Dublin, Ireland', 53.3333, -6.25);
INSERT INTO `loccodes` VALUES (86, 'ENG.LPL', 'Liverpool, England', 53.4167, -3);
INSERT INTO `loccodes` VALUES (87, 'ENG.MAN', 'Manchester, England', 53.5, -2.25);
INSERT INTO `loccodes` VALUES (88, 'ENG.BHX', 'Birmingham, England', 524167, -1.9167);
INSERT INTO `loccodes` VALUES (89, 'WAL.CWL', 'Cardiff, Wales', 51.4813, -3.1805);
INSERT INTO `loccodes` VALUES (90, 'USA.MA.BOS', 'Boston, MA, USA', 42.3584, -71.0598);
INSERT INTO `loccodes` VALUES (91, 'USA.CT.HVN', 'New Haven, CT, USA', 41.3082, -72.9282);
INSERT INTO `loccodes` VALUES (92, 'CAN.YMQ', 'Montreal, Quebec, Canada', 45.5454, -73.6391);
INSERT INTO `loccodes` VALUES (93, 'CAN.YTO', 'Toronto, Ontario, Canada', 43.6702, -79.3868);
INSERT INTO `loccodes` VALUES (94, 'USA.NY.BUF', 'Buffalo, NY, USA', 42.8864, -78.8784);
INSERT INTO `loccodes` VALUES (95, 'USA.OH.CLE', 'Cleveland, OH, USA', 41.4994, -81.6954);
INSERT INTO `loccodes` VALUES (96, 'USA.IL.CHI', 'Chicago, IL, USA', 41.85, -87.6501);
INSERT INTO `loccodes` VALUES (97, 'USA.CA.SFO', 'San Francisco, CA, USA', 37.7749, -122.419);
INSERT INTO `loccodes` VALUES (98, 'ARG.USH', 'Ushuaia, Argentina', -54.7917, -68.2292);
INSERT INTO `loccodes` VALUES (99, 'ANT.HRS', 'Horseshoe Island, Antarctica', -67.8167, -67.3);
INSERT INTO `loccodes` VALUES (100, 'ANT.WAD', 'Waddington Bay, Antarctica', -65.2667, -64.0833);
INSERT INTO `loccodes` VALUES (101, 'ANT.PET', 'Petermann Island, Antarctica', -65.1667, -64.1667);
INSERT INTO `loccodes` VALUES (102, 'ANT.PLN', 'Pleneau Island, Antarctica', -65.1, -64.0667);
INSERT INTO `loccodes` VALUES (103, 'ANT.DNC', 'Danco Island, Antarctica', -64.7333, -62.1667);
INSERT INTO `loccodes` VALUES (104, 'ANT.PRD', 'Paradise Harbor, Antarctica', -64.8167, -62.8667);
INSERT INTO `loccodes` VALUES (105, 'ANT.DEC', 'Deception Island, Antarctica', -62.9523, -60.5857);
INSERT INTO `loccodes` VALUES (106, 'ARG.BGL', 'Beagle Channel, Argentina', -55.1, -66.5);
INSERT INTO `loccodes` VALUES (107, 'USA.ID.BOI', 'Boise, ID, USA', 43.6126, -116.211);
INSERT INTO `loccodes` VALUES (108, 'CAN.YYJ', 'Victoria, BC, Canada', 48.4286, -123.366);
INSERT INTO `loccodes` VALUES (109, 'USA.OR.PDX', 'Portland, Oregon, USA', 45.5235, -122.676);
INSERT INTO `loccodes` VALUES (110, 'USA.OR.LMT', 'Klamath Falls, Oregon, USA', 42.2249, -121.782);
INSERT INTO `loccodes` VALUES (111, 'USA.NV.BRC', 'Black Rock City, Nevada, USA', 40.7692, -119.22);
INSERT INTO `loccodes` VALUES (112, 'USA.NV.RNO', 'Reno, Nevada, USA', 39.5296, -119.814);
