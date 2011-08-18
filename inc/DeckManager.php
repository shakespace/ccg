<?php

require_once('inc/Const.php');
require_once('inc/DataCache.php');

require_once('inc/Player.class.php');
require_once('inc/Deck.class.php');
require_once('inc/DeckCard.class.php');


/**
* add_to_deck() adds a card into a deck
* Arguments: $player_id - the player's id
*				$deck_id - the deck's id of which the card will be added into
*				$card_id - the card's id of which are adding into the deck
* Return: true, if added the card into deck successfully; otherwise, false.
*/
function add_to_deck($player_id, $deck_id, $card_id, $order = NULL)
{
	/*1, validations */
	//get player infomation from cache memory by $player_id
	//find deck by $deck_id in player's decks
	$player = get_player_info($player_id);
	$deck = $player->decks[$deck_id];
	
	$format = "{result:'%1$s',message:'%2$s'}";
	
	//--check whether the deck exists or not
	//----if not, will create a new deck
	if($deck == NULL)
	{
		return printf($format, 'failed', 'The deck does not exist.');
	}
	
	//--check whether the deck has reached its max card count
	if(count($deck->deck_cards) >= DECK_CARDS_MAX)
	{
		return printf($format, 'failed', 'The deck has reached its max card count.');
	}
	
	//--check whether the card is avaliable in player's card collection
	$card = get_card_info($card_id);
	if(!array_search($card_id,$player->cards))
	{		
		return printf($format, 'failed', 'Player does not own this card.');
	}
	
	/*2, if all pass, then start adding card */
	//check card type
	//--if it is a 'lord' card
	//----check whether there is already LORD card in the deck at position 0
	//------if true, replace with this new LORD card
	//------otherwise, add this card as the LORD of the deck
	
	//--if it is a 'artifact' card
	//----check whether the card at $order can armed with artifact
	//------if true, add this card as a artifact of the card at position = $order
	//------otherwise, failed
	
	//--else
	//----check whether the deck has reached its max cards count.
	//------if true, failed
	//------otherwise, add this card into deck

	if($card->type == CARD_TYPE_ARTIFACT)
	{
		//装备牌
	}
	else
	{
		//其它牌
		$order = count($deck->deck_cards);
		$player->decks[$deck_id]->deck_cards[$order] = new DeckCard($card_id,$order);
	}
	
	/*3, update player */
	//update player's information into cache memory
	//--remove this card from player's cards collection
	//--update player's deck collection
	
	update_player_info($player);
	
	/*4, return results */
	//return results in JSON in wrap
	return printf($format, 'Successful', '');
}

/**
* remove_from_deck() removes a deck card from a specified deck.
* Arguments: $player_id - the player's id
*				$deck_id - the deck id
*				$card_order - the order where the card in deck
* Return: true, if remove the card from deck successfully; otherwise, false.
*/
function remove_from_deck($player_id, $deck_id, $card_order)
{
	/*1, validations */
	//get player infomation from cache memory by $player_id
	//find deck by $deck_id in player's decks
	//--check whether deck exists or not
	//--check whether card at $card_order exists in deck
	
	/*2, if all pass, then start removing card */
	//remove the card from deck 
	//--check whether this card have armed with artifact or not?
	//----if yes, dismantle the artifacts, and add this two card back into player's cards
	//----otherwise, add this card back into player's cards
	//--update the orders of other deckcards in the deck
	
	/*3, update player */
	//update player's information into cache memory
	//--player's cards
	//--player's deck
	
	/*4, return results */
	//return results in JSON in wrap
}

/**
* switch_deck() will switch a specified deck as default deck for the player
* Arguments: $player_id - the player's id
*				$deck_id - the id of the deck which are switching to default deck
* Return: true, if switch deck successfully; otherwise, false.
*/
function switch_deck($player_id, $deck_id)
{
	/*1, validations */
	//get player infomation from cache memory by $player_id
	//find deck by $deck_id in player's decks
	//--check whether deck exists or not
	//--check whether the deck has lord card at position 0
	
	/*2, if all pass, then start switching deck */
	//find the default deck in player's deck collection and remove if from default
	//set current deck as default deck
	
	/*3, update player */
	//update player's data into cache memory
	//--player's current deckid
	
	/*4, return results */
	//return results in JSON in wrap
}

?>