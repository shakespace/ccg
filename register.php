<?php

$format = "{result:'%s',message:'%s'}";
/* 1, verify parameter */
//any required fields missing
if(!isset($_POST['username'])){
	die(printf($format, 'failed', '"username" cannot be null or empty.'));
}

if(!isset($_POST['password'])){
	die(printf($format, 'failed', '"password" cannot be null or empty.'));
}

if(!isset($_POST['email'])){
	die(printf($format, 'failed', '"email" cannot be null or empty.'));
}

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

//include DB.php since we will use it to call database
require_once('inc/DB.php');

/* 2, verify user */
//verify whether user exists
//--if true, return failed
//--otherwise, start regist user
$con = DatabaseConnection::getInstance();
$sql = "SELECT COUNT(1) AS `total` FROM `player` WHERE `name` = '".mysql_real_escape_string($username)."'";
$result = $con->query($sql);

if($result){
	$row = mysql_fetch_assoc($result);
	if($row['total'] > 0 ){
		die(printf($format, 'failed', 'User "'. $username .'" already exist.'));
	}
}

//include const.php since we will use it to add default values for player
require_once('inc/Const.php');
/* 3, regist user */
$result = $con->query("CALL `sp_player_add`('". mysql_real_escape_string($username) ."', ". PLAYER_TYPE_CCG ." ,'". md5($password) ."','".mysql_real_escape_string($email)."',".STAMINA_DEFAULT.",@id);");
$result = $con->query('SELECT @id AS player_id');

if($result !== false){
	$row = mysql_fetch_assoc($result);
	$player_id = $row['player_id'];
	die(printf($format, 'successful', 'player='.$player_id));
}
else{
	die(printf($format, 'failed', $con->last_error()));
}

?>