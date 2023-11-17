
-- ------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- Altered implementation : © <Your name here> <Your email address here>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-- -----

CREATE TABLE IF NOT EXISTS `meeples` (
  `meeple_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meeple_location` varchar(32) NOT NULL,
  `meeple_state` int(10),
  `type` varchar(32),
  `player_id` int(10) NULL,
  PRIMARY KEY (`meeple_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Store cards
CREATE TABLE IF NOT EXISTS `cards` (
  `card_id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `card_location` varchar(32) NOT NULL,
  `card_state` int(10) DEFAULT 0,
  `player_id` int(10) NULL,
  `initial_properties`JSON NULL, 
  `properties` JSON NULL, 
  PRIMARY KEY (`card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- `boostEffect` JSON NULL, --['boostEffect', 'obj'], // ['mountain' => X, 'forest' => Y, ...]
--   `faction`VARCHAR(20),
--   `effectSupport`JSON NULL,
--   `effectHand` JSON NULL, --played from hand
--   `effectReserve` JSON NULL, -- played from reserve
--   `effectPassive` JSON NULL, -- [[listener type => action]]: listener type to distinguish
--   `costModifier` JSON NULL, -- ['costModifier', 'obj'], // ['hand'=> action check, 'reserve' => action check]
--   `initialProperties`JSON NULL, 
--   `altered_properties` JSON NULL -- will superseed original properties if needed

-- Additional player's info
ALTER TABLE `player` ADD `faction` varchar(10);

-- CORE TABLES --
CREATE TABLE IF NOT EXISTS `global_variables` (
  `name` varchar(255) NOT NULL,
  `value` JSON,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user_preferences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player_id` int(10) NOT NULL,
  `pref_id` int(10) NOT NULL,
  `pref_value` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `move_id` int(10) NOT NULL,
  `table` varchar(32) NOT NULL,
  `primary` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL,
  `affected` JSON,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `gamelog` ADD `cancel` TINYINT(1) NOT NULL DEFAULT 0;
