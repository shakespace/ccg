<?php
	
	$playerId = $_GET['playerId'];
	$sessionId = $_GET['sessionId'];

	//required parameter validations.

	//security validations.
	
	require_once('inc/DeckManager.php');
	
	$method = $_GET['method'];
	$data = null;
	switch($method)
	{
		case 'addToDeck':
			$data = add_to_deck($_POST['playerId'], $_POST['deckId'], $_POST['cardId']);
		break;
		case 'remove_from_deck':
			$data = remove_from_deck($_POST['player_id'], $_POST['deckId'], $_POST['cardOrder']);
		break;
		case 'test':
			require_once('inc/DataCache.php');
			$data = json_encode(get_all_cards());
		break;
		case 'testCard':
			require_once('inc/DataCache.php');
			$data = json_encode(get_all_cards());
		break;
			
		case 'testStamina':
			require_once('inc/Common.php');
			require_once('inc/DataCache.php');
			$playerId = $_GET['playerId'];
			$dec_sta = $_GET['useStamina'];
			$player = getPlayerInfo($playerId);
			debug_print($player);
			$ret = updateStamina($player, $dec_sta);
		break;
			
		case 'startMission':
			$missionId = $_GET['missionId'];
			require_once('inc/BattleManager.php');
			startMission($playerId, $missionId);
		break;
		
		case 'testAddCard':
			$deckId = $_GET['deckId'];
			$cardId = $_GET['cardId'];
			require_once('inc/DeckManager.php');
			addToDeck($playerId, $deckId, $cardId);
		break;
		
		case 'testRemoveCard':
			$deckId = $_GET['deckId'];
			$order = $_GET['order'];
			require_once('inc/DeckManager.php');
			removeFromDeck($playerId, $deckId, $order);
		break;
		
		case 'clearCache':
			require_once('inc/CacheManager.php');
			CacheManager::clearCache();
		break;
		
		default:
		
	}
	
	print_r($data);
	
	//send $data back in JSON in wrap
	//HttpResponse::setCache(false);
	//HttpResponse::setContentType('application/json');
	//HttpResponse::setData($data);
	//HttpResponse::send();
?>