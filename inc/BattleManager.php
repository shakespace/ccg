<?php



function initMission($mid)
{
	$allmissions = getMissions();
	//debug_print($allmissions);
	if (in_array($mid, array_keys($allmissions)))
	{
		debug_print($allmissions[$mid]);
	}
	else
	{
		echo 'Mission '.$mid.' does not exist!<br/>';
	}
}

function startMission($playerId, $missionId)
{
	require_once('inc/Common.php');
	require_once('inc/DataCache.php');
	require_once('inc/Battle.class.php');
	//check if player is already engaged in battle
	$player = getPlayerInfo($playerId);
	$battle = $player->currentBattle;
	if ($battle) { //not null
		//remove curent battle
	}
	
	$mission = getMissionInfo($missionId);
	
	//init
	$battle = new Battle();
	
	$battle->id = $missionId;
	
	$battle->startTime = time();
	/*
	public $end_time;
	
	//????
	public $version;
	
	//????,??vs???
	public $player_role;
	public $attacker_name;
	public $defender_name;
	public $attacher_deck;
	public $defender_deck;
	public $attacker_shuffle;
	public $defender_shuffle;
	
	//????
	public $win_condition;
	public $win_condition_param;
	public $lose_condition;
	public $lose_condition_param;
	public $current_round;
	public $current_player;
		
		//??????????
		public $actions;
		
		//????
		public $battle_result;

	*/
	
	//save to cache
	$player['currentBattle'] = $battle;
	updatePlayerInfo($player);
	
}

/**
* update_battle() called when player make actions in the battle, such as play cards, attack...
* Arguments:	$player_id - 
* 				$battle_id - the battle which player is playing
*				$action - the action which player makes
* Return: 
*/
function updateBattle($playerId, $battleId, $action)
{
	
}

?>