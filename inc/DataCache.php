<?php
	
require_once('inc/CacheManager.php');
require_once('inc/Common.php');
require_once('inc/DB.php');

/**
* get_call_cards() will get all the cards from cache memory, 
* if the cards exist in cache memory, return all the cards
* if not, will load cards from xml file, save them into cache memory, and return all the cards
* Return: an array with all of the cards.
* Examples: $allCards = get_all_cards();
*/
function get_all_cards()
{	
	// 1 day
	$duration = 86400;
	$group = "CARD";
	$key = "all_cards";
	
	$cachedCards = CacheManager::getValue($key, $group);
	
	if(!$cachedCards)
	{
		// parse cards from xml file
		$cachedCards = getCardsFromXML();//xml2array(file_get_contents('./xml/cards.xml'), 1, 'attribute');
		// save cards into cache memory
		CacheManager::setValue($key, $group, $cachedCards, $duration);
	}
	
	return $cachedCards;
}

/**
* get_card_info() gets the detail information of one specified card
* Arguments: $card_id - the card id
* Return: A card object
* Examples: $card_id = get_card_info(10001);
*/
function get_card_info($card_id)
{
	$group = "CARD";
	
	$cachedCard = CacheManager::getValue($card_id, $group);
	if(!$cachedCard)
	{
		// parse cards from xml file
		$allCards = get_all_cards();
		$cachedCard = $allCards[$card_id];
		// save cards into cache memory
		CacheManager::setValue($card_id, $group, $cachedCard, 86400);
	}
	
	return cachedCards;
}

/**
* get_player_info() gets detail information of a player
* if the player's info already exist in cache memory, then return the player
* otherwise, get its info from database and save into cache memory, then return the player.
* Arguments: $player_id - the player's id
* Return: A player object contains all detail information of the player
*/
function get_player_info($player_id)
{
	$group = "PLAYER";
	$cachedPlayer = CacheManager::getValue($player_id, $group);
	if(!$cachedPlayer)
	{
		//get player's information from database
		$db = DatabaseConnection::getInstance();
		$cachedPlayer = $db->query('SELECT * FROM player WHERE id =' . $player_id);
		//save into cache memory
		CacheManager::setValue($player_id, $group, $cachedPlayer, 3600);
	}
	
	return $cachedPlayer;
}

/**
* update_player_info() saves player's information into cache memory
*/
function update_player_info($player)
{
	CacheManager::setValue($player->id, 'PLAYER', $player, 3600);
}



?>