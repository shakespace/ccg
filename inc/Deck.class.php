<?php

class Deck
{
	public $player_id;
	public $id;

	//数组
	public $deck_cards;
	
	function Deck($player_id, $deck_id)
	{
		$this->player_id = $player_id;
		$this->id = $deck_id;
	}
}

?>