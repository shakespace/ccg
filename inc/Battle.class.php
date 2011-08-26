<?php
	class Battle
	{
		public $id;
		
		//开始结束时间
		public $startTime;
		public $endTime;
		
		//游戏版本
		public $version;
		
		//对战双方，天灾vs近卫？
		public $playerRole;
		public $attackerName;
		public $defenderName;
		public $attacherDeck;
		public $defenderDeck;
		public $attackerShuffle;
		public $defenderShuffle;
		
		//战役胜负
		public $winCondition;
		public $winConditionParam;
		public $loseCondition;
		public $loseConditionParam;
		public $currentRound;
		public $currentPlayer;
		
		//战斗每回合的记录信息
		public $actions;
		
		//战斗结果
		public $battleResult;
	}
?>