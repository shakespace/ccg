DROP PROCEDURE IF EXISTS `sp_player_cards_add`//

CREATE PROCEDURE `sp_player_cards_add`(
	IN playerId INT,
	IN cardId INT
)
BEGIN
	
	DECLARE cardCount INT DEFAULT 0;
	
	-- check whether player own this card
	SELECT cardCount = COUNT(1)
	FROM `player_cards`
	WHERE `playerId` = playerId
	AND `cardId` = cardId;
	
	IF ( IFNULL(cardCount,0) > 0) THEN
		-- if true, add the count of this card in player's cards collection
		UPDATE `player_cards`
		SET		`count` =  IFNULL(`count`, 0) + 1
		WHERE `playerId` = playerId
		AND		`cardId` = cardId;
	ELSE
		-- otherwise, insert this card into player's cards collection
		INSERT INTO `player_cards`(`playerId`,`cardId`, `count`)
		VALUES(playerId, cardId, 1);
	END IF;


END//