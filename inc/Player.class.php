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
		public $create_time;
		
		//个人信息，比如身份证，手机号码什么的，用于找回账户
		
		//last login session id
		public $current_session;
		
		//金钱数: 金银铜
		public $copper;
		public $gold;
		
		//经验xp
		public $exp;
		//等级
		public $level;
		
		//行动值
		public $stamina;
		public $stamina_last_update;
		
		//副本或者战役CD
		public $raid_records;
		
		//声望
		public $factions;
		
		//公会
		public $guild_id;
		public $guild_rank;
		
		//竞技场
		public $arena_point;
		public $arena_rank;
		
		//成就
		public $achievements;
		
		//任务进度
		public $mission_records;
		
		//消费记录.包括:消费记录、总计消费行动力、等等
		public $spending_history;
		
		// An array to store all the card ids of the player
		public $cards;
		
		// An array to store all the decks of the player
		public $decks;
		public $default_deck; //deckid
		
		//currently running battle
		public $current_battle;
		
	}

?>