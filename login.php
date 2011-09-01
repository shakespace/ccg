<?php

	require_once('inc/DataCache.php');
	require_once("inc/guid.class.php");
	require_once("inc/CacheManager.php");	
	require_once("inc/DB.php");
	
	$userName = $_GET["UserName"];
	$password = $_GET["Password"];
	//echo $password;
	
    //if(empty($userName) || empty($password))
	if(!isset($userName) || !isset($password))
	{
        die("{result:'failed',error:'用户名或密码为空！'}");
	}
	
	$db = DatabaseConnection::getInstance();
	$user = mysql_real_escape_string($userName);
    $pwd = mysql_real_escape_string($password);
    $sql = "SELECT `id` FROM `player` WHERE `name`='" . $user . "' AND `auth`='" . $pwd . "'";
	//echo $sql;
    $result = $db->query($sql);
	
	if(!$result){
		//not player found
		die("{result:'failed',error:'用户不存在！'}");
	}
	$row = mysql_fetch_array($result);
	//echo $row['id'];
	$timeStamp = date('Y-m-d H:i:s');
	//echo $timeStamp;
	$player = getPlayerInfo($row['id']);
    //CacheManager::setValue($result,$sessionId);
    $computer_name = $_SERVER["SERVER_NAME"];
    $ip = $_SERVER["SERVER_ADDR"];
    $Guid = new Guid($computer_name, $ip);
    //print $guid->toString();
    $sessionId = $Guid->toString();
	//print $sessionId;
    //echo"{result:'Successful',message:'', playerId:" . $row['id'] . ",sessionId:" . $sessionId . ",timeStamp:" . $timeStamp . ",playerinfo:'" . json_encode($player) ."',playerCards:'" . json_encode($player->cards)."',playerDecks:'" . json_encode($player->decks)."',playerMissons:'" . json_encode($player->missionRecords)."'}";
	$arr= array('result:'=>'successful','message:'=>'','playid:'=> $row['id'],'sessionId'=>$sessionId,'timeStamp'=>$timeStamp,'playerinfo:'=>$player,'playerCards:'=> $player->cards,'playerDecks:'=>$player->decks,'playerMissons:'=>$player->missionRecords);
	echo json_encode($arr);

?>
