<?php
	
	define('DECK_CARDS_MAX',20);
	
	
	//卡牌类型：CARD_TYPE_
	//主公：lord
	//建筑：building
	//武将：hero
	//士兵：unit
	//	武将和士兵统称army
	//计策：spell
	//装备：artifact
	define('CARD_TYPE_LORD',0);
	define('CARD_TYPE_BUILDING',1);
	define('CARD_TYPE_HERO',2);
	define('CARD_TYPE_UNIT',3);
	define('CARD_TYPE_SPELL',4);
	define('CARD_TYPE_ARTIFACT',5);
	
	//卡牌势力或者阵营：CARD_FACTION_
	//魏、蜀、吴、群
	define('CARD_FACTION_WEI',0);
	define('CARD_FACTION_SHU',1);
	define('CARD_FACTION_WU',2);
	define('CARD_FACTION_QUN',3);
	
	//卡牌稀有度: CARD_RARITY_
	//普通common: black
	//特殊uncommon: silver
	//稀有rare: gold
	//史诗epic: purple
	define('CARD_RARITY_COMMON',0);
	define('CARD_RARITY_UNCOMMON',1);
	define('CARD_RARITY_RARE',2);
	define('CARD_RARITY_EPIC',3);
	
	//玩家类型：PLAYER_TYPE_
	//内部CCG
	//微博WEIBO
	//人人网RENREN
	//...
	define('PLAYER_TYPE_CCG',0);
	define('PLAYER_TYPE_WEIBO',1);
	define('PLAYER_TYPE_RENREN',2);
	
	//技能类型：SKILL_TYPE_
	//主动技active
	//被动技passive
	//攻击技attack
	//防御技defense
	define('SKILL_TYPE_ACTIVE',0);
	define('SKILL_TYPE_PASSIVE',1);
	define('SKILL_TYPE_ATTACK',2);
	define('SKILL_TYPE_DEFENSE',3);
	
?>