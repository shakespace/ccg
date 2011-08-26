<?php

class Deck
{

public $id;

//数组
public $deckCards;
public $equipments;

//constructor
function Deck($deckId) {
	$this->id = $deckId;
} //constructor

//add lord. update player cards as well
function addLord($cardId, &$player) {
	if ($player->availableCardNum($cardId) <= 0) {
		throw new Exception('player does not own this card');
	}
	$prevLordId = $this->deckCards['0'];
	if ($prevLordId) {
		//already has a lord. replace it
		$player->receiveCard($prevLordId);
		$this->deckCards['0'] = $cardId;
		$player->discardCard($cardId);
		$prevEquipId = $this->equipments['0'];
		if ($prevEquipId) {
			$player->receiveCard($prevEquipId);
			unset($this->equipments['0']);
		}
	} else {
		$this->deckCards['0'] = $cardId;
		$player->discardCard($cardId);
	}
	//require_once('inc/DataCache.php');
	//updatePlayerInfo($player);
} //add lord

//add unit or building or spell
function addArmy($cardId, &$player) {
	if ($player->availableCardNum($cardId) <= 0) {
		throw new Exception('player does not own this card');
	}
	for ($i=1,$found=0;$i<=DECK_CARDS_MAX;$i++) {
		if (!isset($this->deckCards[$i])) {
			$found = $i;
			break;
		}
	}
	if ($found>0) {
		$this->deckCards[$found] = $cardId;
		$player->discardCard($cardId);
	} else {
		throw new Exception('deck is full');
	}
} //add army

function removeArmy($order, &$player) {
	if (isset($this->deckCards[$order])) {
		$player->receiveCard($this->deckCards[$order]);
		unset($this->deckCards[$order]);
		if (isset($this->equipments[$order])) {
			$player->receiveCard($this->equipments[$order]);
			unset($this->equipments[$order]);
		}
	} else {
		throw new Exception('card does not exists at this position');
	}
} //remove army

//add artifact
function addArtifact($cardId, &$player) {
} //add artifact

function removeArtifact($order, &$player) {
} //remove artifact

} //class

?>