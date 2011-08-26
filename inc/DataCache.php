<?php
	
require_once('inc/CacheManager.php');
require_once('inc/Common.php');
require_once('inc/DB.php');
require_once('inc/Player.class.php');
require_once('inc/Deck.class.php');

/**
* getAllCards() will get all the cards from cache memory, 
* if the cards exist in cache memory, return all the cards
* if not, will load cards from xml file, save them into cache memory, and return all the cards
* Return: an array with all of the cards.
* Examples: $allCards = getAllCards();
*/
function getAllCards() {	
	// 1 day
	$duration = 86400;
	$group = "CARD";
	$key = "all_cards";
	
	$cachedCards = CacheManager::getValue($key, $group);
	
	if(!$cachedCards) {
		// parse cards from xml file
		$cachedCards = getCardsFromXML();//xml2array(file_get_contents('./xml/cards.xml'), 1, 'attribute');
		// save cards into cache memory
		CacheManager::setValue($key, $group, $cachedCards, $duration);
	}
	
	//debug_print('all cards ');
	//debug_print($cachedCards);
	return $cachedCards;
}

/**
* getCardInfo() gets the detail information of one specified card
* Arguments: $cardId - the card id
* Return: A card object
* Examples: $cardId = getCardInfo(10001);
*/
function getCardInfo($cardId) {
	$group = "CARD";
	
	$cachedCard = CacheManager::getValue($cardId, $group);
	if(!$cachedCard) {
		// parse cards from xml file
		$allCards = getAllCards();
		$cachedCard = $allCards[$cardId];
		// save cards into cache memory
		CacheManager::setValue($cardId, $group, $cachedCard, 86400);
	}
	//debug_print('card '.$cardId);
	//debug_print($cachedCard);
	return $cachedCard;
}













function getAllMissions() {	
	// 1 day
	$duration = 86400;
	$group = "MISSION";
	$key = "all_missions";
	
	$missions = CacheManager::getValue($key, $group);
	
	if(!$missions) {
		$missions = getMissionsFromXML();
		CacheManager::setValue($key, $group, $missions, $duration);
	}
	
	return $missions;
}

function getMissionInfo($missionId) {
	$group = "MISSION";
	
	$mission = CacheManager::getValue($missionId, $group);
	if(!$mission) {
		$allMissions = getAllMissions();
		$mission = $allMissions[$missionId];
		CacheManager::setValue($missionId, $group, $mission, 86400);
	}
	
	return $mission;
}




/**
* get_player_info() gets detail information of a player
* if the player's info already exist in cache memory, then return the player
* otherwise, get its info from database and save into cache memory, then return the player.
* Arguments: $player_id - the player's id
* Return: A player object contains all detail information of the player
*/
function getPlayerInfo($playerId) {
	$group = "PLAYER";
	$playerId = mysql_real_escape_string($playerId);
	$player = CacheManager::getValue($playerId, $group);
	if(!$player) {
		//get player's information from database
		$db = DatabaseConnection::getInstance();
		$record = $db->query("SELECT * FROM player WHERE id=$playerId");
		
		if ($record) {
			$player = new Player(mysql_fetch_array($record, MYSQL_ASSOC));
			
			//get Cards
			$player->cards = array();
			$cardRecord = $db->query("SELECT * FROM player_cards WHERE playerId=$playerId");
			while ($row = mysql_fetch_array($cardRecord, MYSQL_ASSOC)) {
				$player->cards[$row['cardId']] = $row['count'];
			}
			
			//get Decks
			$player->decks = array();
			$deckRecord = $db->query("SELECT * FROM player_decks WHERE playerId=$playerId");
			while ($row = mysql_fetch_array($deckRecord, MYSQL_ASSOC)) {
				if (!isset($player->decks[$row['deckId']])) {
					$player->decks[$row['deckId']] = new Deck($row['deckId']);
				}
				$deck = $player->decks[$row['deckId']];
				$deck->deckCards[$row['order']] = $row['cardId'];
				$deck->equipments[$row['order']] = $row['artifactId'];
			}
			
			//get mission records
			$player->missionRecords = array(
				'numTries' => array(),
				'numWins' => array()
			);
			$missionRecord = $db->query("SELECT * FROM player_mission_records WHERE playerId=$playerId");
			while ($row = mysql_fetch_array($missionRecord, MYSQL_ASSOC)) {
				$player->missionRecords['numTries'][$row['missionId']] = $row['numTries'];
				$player->missionRecords['numWins'][$row['missionId']] = $row['nuWins'];
			}
			
			//save into cache memory
			CacheManager::setValue($playerId, $group, $player, 3600);
		} else {
			//error, not found
		}
		
	}
	
	return $player;
}

/**
* update_player_info() saves player's information into cache memory
*/
function updatePlayerInfo($player, $updateInfo=null, $updateDeck=null, $updateCards=null, $updateMissionRecords=null) {
	CacheManager::setValue($player->id, 'PLAYER', $player, 3600);
	//update db
	
	//--- TO DO: convert everything below into SP ---
	
	/*
	$db = DatabaseConnection::getInstance();
	$playerId = $player->id;
	
	if (!$updateInfo) {
		//update basic info
	}
	if (!$updateDeck) {
		//update player_deck
		$deckId = $updateDeck['deckId'];
		$order = $updateDeck['order'];
		$cardId = $player->decks[$deckId]->deckCards[$order];
		$equipId = $player->decks[$deckId]->equipments[$order];
		//first do delete
		$record = $db->query("DELETE FROM player_decks WHERE playerId=$playerId AND deckId=$deckId AND order=$order");
		//add new value back
		if ($cardId && $cardId>0) {
			if (!$equipId) $equipId = 'null';
			$record = $db->query("INSERT INTO player_decks (playerId, deckId, order, cardId, equipId) VALUES ($playerId, $deckId, $order, $cardId, $equipId)");
		}
	}
	*/
}



/*
function getCurrentBattleByPlayer($playerId) {
	$group = 'BATTLE';
	$battle = CacheManager::getValue($playerId, $group);
	return $battle;
}
*/



?>