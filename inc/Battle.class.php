<?php
	class Battle
	{
		public $id;
		
		//开始结束时间
		public $start_time;
		public $end_time;
		
		//游戏版本
		public $version;
		
		//对战双方，天灾vs近卫？
		public $player_role;
		public $attacker_name;
		public $defender_name;
		public $attacher_deck;
		public $defender_deck;
		public $attacker_shuffle;
		public $defender_shuffle;
		
		//战役胜负
		public $win_condition;
		public $win_condition_param;
		public $lose_condition;
		public $lose_condition_param;
		public $current_round;
		public $current_player;
		
		//战斗每回合的记录信息
		public $actions;
		
		//战斗结果
		public $battle_result;
	}
?>