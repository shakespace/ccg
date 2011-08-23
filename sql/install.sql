-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2011 at 08:15 AM
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
  `create_time` bigint(10) unsigned NOT NULL,
  `copper` int(10) unsigned NOT NULL,
  `gold` int(10) unsigned NOT NULL,
  `exp` int(10) unsigned NOT NULL,
  `level` int(10) unsigned NOT NULL,
  `stamina` int(10) unsigned NOT NULL,
  `stamina_last_update` bigint(10) unsigned NOT NULL,
  `default_deck` int(10) unsigned NOT NULL DEFAULT '1',
  `current_battle` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `name`, `type`, `auth`, `email`, `create_time`, `copper`, `gold`, `exp`, `level`, `stamina`, `stamina_last_update`, `default_deck`, `current_battle`) VALUES
(1, 'Philip', 1, '111111', 'admin@kayoku.com', 1, 100, 100, 0, 1, 100, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `player_cards`
--

DROP TABLE IF EXISTS `player_cards`;
CREATE TABLE IF NOT EXISTS `player_cards` (
  `player_id` int(10) unsigned NOT NULL,
  `card_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

--
-- Dumping data for table `player_cards`
--


-- --------------------------------------------------------

--
-- Table structure for table `player_decks`
--

DROP TABLE IF EXISTS `player_decks`;
CREATE TABLE IF NOT EXISTS `player_decks` (
  `player_id` int(10) unsigned NOT NULL,
  `deck_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `card_id` int(10) unsigned NOT NULL,
  `antifact_id` int(10) unsigned DEFAULT NULL,
  UNIQUE KEY `player_deck_index` (`player_id`,`deck_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

--
-- Dumping data for table `player_decks`
--

