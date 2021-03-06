﻿<?php
	
	define('DECK_CARDS_MAX',20);
	
	define('STAMINA_MAX',100);
	define('STAMINA_PER_MIN',1);
	
	define('CACHE_GROUP_SYSTEM', 'SYSTEM');
	define('CACHE_GROUP_PLAYER', 'PLAYER');
	define('CACHE_GROUP_MISSION', 'MISSION');
	define('CACHE_GROUP_CARD', 'CARD');
	define('CACHE_GROUP_BATTLE', 'BATTLE');
	
	
	//卡牌类型：CARD_TYPE_
	//主公：lord
	//建筑：building
	//士兵：unit
	//计策：spell
	//装备：artifact
	define('CARD_TYPE_LORD','lord');
	define('CARD_TYPE_BUILDING','building');
	define('CARD_TYPE_UNIT','unit');
	define('CARD_TYPE_SPELL','spell');
	define('CARD_TYPE_ARTIFACT','artifact');
	
	//卡牌在牌组中允许出现次数：CARD_OCCUR_
	//唯一：UNIQUE
	//可重复：MULTI
	define('CARD_OCCUR_MULTI',0);
	define('CARD_OCCUR_UNIQUE',1);

	//卡牌势力或者阵营：CARD_FACTION_
	//魏、蜀、吴、群
	define('CARD_FACTION_WEI','wei');
	define('CARD_FACTION_SHU','shu');
	define('CARD_FACTION_WU','wu');
	define('CARD_FACTION_QUN','qun');
	
	//卡包: CARD_PACKAGE_
	//非玩家：npc
	//奖励:reward
	//黄巾之乱：HUANGJIN
	//官渡之战：GUANDU
	//赤壁之战：CHIBI
	//三国鼎立：SANGUO
	define('CARD_PACKAGE_NPC','npc');
	define('CARD_PACKAGE_REWARD','reward');
	define('CARD_PACKAGE_HUANGJIN','huangjin');
	define('CARD_PACKAGE_GUANDU','guandu');
	define('CARD_PACKAGE_CHIBI','chibi');
	define('CARD_PACKAGE_SANGUO','sanguo');
	
	//卡牌稀有度: CARD_RARITY_
	//普通common: black
	//罕见uncommon: silver
	//稀有rare: gold
	//史诗epic: purple
	define('CARD_RARITY_COMMON','common');
	define('CARD_RARITY_UNCOMMON','uncommon');
	define('CARD_RARITY_RARE','rare');
	define('CARD_RARITY_EPIC','epic');
	
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