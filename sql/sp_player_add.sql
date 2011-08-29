DROP PROCEDURE IF EXISTS `sp_player_add`//

CREATE PROCEDURE `sp_player_add`(
	IN name VARCHAR(50),
	IN type INT(2) UNSIGNED,
	IN auth VARCHAR(100),
	IN email VARCHAR(255),
	IN stamina INT(10) UNSIGNED,
	OUT playerId INT
)
BEGIN 

	DECLARE new_id INT DEFAULT 0;
	DECLARE cur_order INT DEFAULT 0;
	DECLARE now_to_sec INT DEFAULT 0;

	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;

	START TRANSACTION;
	
	-- convert current datetime to seconds
	SET now_to_sec = TIME_TO_SEC(NOW());
	
	-- 1, add player
	INSERT INTO `player`(`name`,`type`,`auth`,`email`,`createTime`,`copper`,`gold`,`exp`,`level`,`stamina`,`staminaLastUpdate`,`defaultDeck`)
	VALUES(name,type,auth,email,now_to_sec,0,0,0,0,stamina,now_to_sec,1);
	
	-- get last insert id as player's id
	SET new_id = LAST_INSERT_ID();
	
	-- 2, add deck to this player's deck collection
	-- --a. add lord card to player's default deck 
	-- ------meanwhile it will automatically create a new deck for player
	INSERT INTO `player_decks`(`playerId`,`deckId`,`order`,`cardId`)
	VALUES(new_id,1,cur_order,1);
	
	-- --b. add tow normal cards to player's default deck
	SET cur_order = cur_order + 1;
	INSERT INTO `player_decks`(`playerId`,`deckId`,`order`,`cardId`)
	VALUES(new_id,1,cur_order,2);
	
	SET cur_order = cur_order + 1;
	INSERT INTO `player_decks`(`playerId`,`deckId`,`order`,`cardId`)
	VALUES(new_id,1,cur_order,3);
	
	-- 3. return new player's id
	SET playerId = new_id;

	COMMIT;

END//

/* sample call
CALL `sp_player_add`('karenin',0,'111111','eric.ganym@gmail.com',200,@id);
SELECT @id AS playerId;
*/

