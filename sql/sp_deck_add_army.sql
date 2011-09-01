DROP PROCEDURE IF EXISTS `sp_deck_add_army`//

CREATE PROCEDURE `sp_deck_add_army`(
	IN playerId INT,
	IN deckId INT,
	IN cardId INT
)
BEGIN

	DECLARE cur_order INT DEFAULT 0;
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
	
	START TRANSACTION;
	
	-- 1, add this card into player's deck cards collections
	-- get the max card order of player's deck cards collection
	SELECT cur_order = MAX(`order`)
	FROM `player_decks`
	WHERE `playerId` = playerId
	AND `deckId` = deckId
	GROUP BY `playerId`, `deckId`;
	
	-- insert
	INSERT INTO `player_decks`(`playerId`, `deckId`, `order`, `cardId`)
	VALUES(playerId, deckId, cur_order + 1, cardId);

	-- 2, discard this card from player's cards collection
	CALL `sp_player_cards_discard`(playerId,cardId);

	COMMIT;

END//