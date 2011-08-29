-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2011 at 04:10 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ccg`
--

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` int(2) unsigned NOT NULL,
  `auth` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `createTime` bigint(10) unsigned NOT NULL,
  `copper` int(10) unsigned NOT NULL,
  `gold` int(10) unsigned NOT NULL,
  `exp` int(10) unsigned NOT NULL,
  `level` int(10) unsigned NOT NULL,
  `stamina` int(10) unsigned NOT NULL,
  `staminaLastUpdate` bigint(10) unsigned NOT NULL,
  `defaultDeck` int(10) unsigned NOT NULL DEFAULT '1',
  `currentBattle` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `name`, `type`, `auth`, `email`, `createTime`, `copper`, `gold`, `exp`, `level`, `stamina`, `staminaLastUpdate`, `defaultDeck`, `currentBattle`) VALUES
(1, 'Philip', 1, '111111', 'admin@kayoku.com', 1, 100, 100, 0, 1, 100, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `player_cards`
--

DROP TABLE IF EXISTS `player_cards`;
CREATE TABLE IF NOT EXISTS `player_cards` (
  `playerId` int(10) unsigned NOT NULL,
  `cardId` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`playerId`,`cardId`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

--
-- Dumping data for table `player_cards`
--

INSERT INTO `player_cards` (`playerId`, `cardId`, `count`) VALUES
(1, 2, 1),
(1, 3, 2),
(1, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `player_decks`
--

DROP TABLE IF EXISTS `player_decks`;
CREATE TABLE IF NOT EXISTS `player_decks` (
  `playerId` int(10) unsigned NOT NULL,
  `deckId` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `cardId` int(10) unsigned NOT NULL,
  `artifactId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`playerId`,`deckId`,`order`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

--
-- Dumping data for table `player_decks`
--

INSERT INTO `player_decks` (`playerId`, `deckId`, `order`, `cardId`, `artifactId`) VALUES
(1, 1, 0, 1, NULL),
(1, 1, 1, 3, NULL),
(1, 1, 2, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `player_mission_records`
--

DROP TABLE IF EXISTS `player_mission_records`;
CREATE TABLE IF NOT EXISTS `player_mission_records` (
  `playerId` int(10) unsigned NOT NULL,
  `missionId` int(10) unsigned NOT NULL,
  `numTries` int(10) unsigned NOT NULL,
  `numWins` int(10) unsigned NOT NULL,
  PRIMARY KEY (`playerId`,`missionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `player_mission_records`
--

