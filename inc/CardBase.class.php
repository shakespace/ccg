<?php

// 卡牌信息类
class CardBase
{
	public $cardId;
	
	//版本
	public $package;
	//卡牌稀有度: 
	//common: black
	//uncommon: silver
	//rare: gold
	//epic: purple
	public $rarity;
	
	
	//类型：主公、武将、装备、建筑
	//主公：lord
	//建筑：building
	//武将：hero
	//士兵：unit
	//武将和士兵统称army
	//计策：spell
	//装备：artifact
	public $type;
	//势力或者阵营：魏、蜀、吴、群
	public $faction;
	
	//生命值，蓝量，攻击力
	public $maxHp;		//int
	public $maxMp;		//int
	public $baseAttack;	//int
	
	
	//技能, 技能顺序是什么?
	//每张牌最多4个技能
	//其中主动技能最多一个
	public $skills;	//array of skill_id
	
	//使用此张牌需要花费行动力数
	public $cost;
}

?>