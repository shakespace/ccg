<?php
	
	$player_id = $_GET['player_id'];
	$session_id = $_GET['session_id'];

	//required parameter validations.

	//security validations.
	
	require_once('inc/DeckManager.php');
	
	$method = $_GET['method'];
	$data = null;
	switch($method)
	{
		case 'add_to_deck':
			$data = add_to_deck($_POST['player_id'], $_POST['deck_id'], $_POST['card_id']);
		break;
		case 'remove_from_deck':
			$data = remove_from_deck($_POST['player_id'], $_POST['deck_id'], $_POST['card_order']);
		break;
		case 'test':
			require_once('inc/DataCache.php');
			$data = json_encode(get_all_cards());
		break;
	}
	
	print_r($data);
	
	//send $data back in JSON in wrap
	//HttpResponse::setCache(false);
	//HttpResponse::setContentType('application/json');
	//HttpResponse::setData($data);
	//HttpResponse::send();
?>