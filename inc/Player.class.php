<?php

class Player
{
public $id;
public $auth;
//类型:(来自哪个社交网站)
public $type;
public $name;
public $email;
//创建日期
public $createTime;

//个人信息，比如身份证，手机号码什么的，用于找回账户

//last login session id
public $currentSession;

//金钱数: 金银铜
public $copper;
public $gold;

//经验xp
public $exp;
//等级
public $level;

//行动值
public $stamina;
public $staminaLastUpdate;

//副本或者战役CD
public $raidRecords;

//声望
public $factions;

//公会
public $guildId;
public $guildRank;

//竞技场
public $arenaRating;
public $arenaRank;

//成就
public $achievements;

//任务进度
public $missionRecords;

//消费记录.包括:消费记录、总计消费行动力、等等
public $spendingHistory;

// An array to store all the card ids of the player
public $cards;

// An array to store all the decks of the player
public $decks;
public $defaultDeck; //deckid

//currently running battle
public $currentBattle;


//constructor with shallow copy
public function __construct($array)    {
	foreach($this as $key => $value) {
		if (isset($array[$key])) $this->$key = $array[$key];
	}
}

//
function availableCardNum($cardId) {
	if (array_key_exists($cardId, $this->cards)) {
		return $this->cards[$cardId];
	}
	return 0;
}

//acquire card
function receiveCard($cardId, $count=1) {
	if (array_key_exists($cardId, $this->cards)) {
		$this->cards[$cardId] += $count;
		updatePlayerInfo($this);
	} else {
		$this->cards[$cardId] = $count;
		updatePlayerInfo($this);
	}
	
}

//discard card
function discardCard($cardId, $count=1) {
	if (array_key_exists($cardId, $this->cards)) {
		if ($this->cards[$cardId] >= $count) {
			$this->cards[$cardId] -= $count;
		} else {
			throw new Exception('not enough card to discard');
		}
	} else {
		throw new Exception('no card to discard');
	}
}


} //calss

?>