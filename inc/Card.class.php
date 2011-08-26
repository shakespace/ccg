<?php

// 战斗中的卡牌类
class Card 
{
	//卡牌基本信息
	public $id;
	
	public $buff;		//array

	//基础属性。因为可能被装备所修改。
	public $maxHp;		//int
	public $maxMp;		//int
	public $baseAttack;	//int
	//当前属性
	public $hp;
	public $mp;
	public $attack;
	
	//状态：死亡=-1。可用=0。若x>0则表示还需要x轮才能变为可用状态。
	public $readyStatus;  //int
	//本回合是否已经用过主动技能。1=用过了。0=没用过
	public $skillStatus; //int
	
	public $skills;	//array of skill tuples: (id and all params)
	
	//战斗中，处于所布阵的位置
	public $position;
}

?>