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

function start_mission($player_id, $mession_id)
{
	
}

/**
* update_battle() called when player make actions in the battle, such as play cards, attack...
* Arguments:	$player_id - 
* 				$battle_id - the battle which player is playing
*				$action - the action which player makes
* Return: 
*/
function update_battle($player_id, $battle_id, $action)
{
	
}

?>