DROP PROCEDURE IF EXISTS `sp_player_cards_discard`//

CREATE PROCEDURE `sp_player_cards_discard`(
	IN playerId INT,
	IN cardId INT
)
BEGIN

	DECLARE cardCount INT DEFAULT 0;

	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
	
	START TRANSACTION;

	-- check whether player own this artifact card
	SELECT cardCount = COUNT(1)
	FROM `player_cards`
	WHERE `playerId` = playerId
	AND `cardId` = cardId;
	
	IF ( IFNULL(cardCount,0) > 0) THEN
		-- if true, dicard this card from player's cards collection
		UPDATE `player_cards`
		SET		`count` =  CASE 
								WHEN IFNULL(`count`, 0) > 0 THEN `count` - 1
								ELSE 0 
							END
		WHERE `playerId` = playerId
		AND		`cardId` = cardId;
	END IF;
	
	COMMIT;

END//