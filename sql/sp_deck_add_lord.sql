DROP PROCEDURE IF EXISTS `sp_deck_add_lord`//

CREATE PROCEDURE `sp_deck_add_lord`(
	IN playerId INT,
	IN deckId INT,
	IN cardId INT
)
BEGIN

	DECLARE antifactId INT;
	DECLARE oldCardId INT;
	DECLARE cardCount INT DEFAULT 0;

	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
	
	START TRANSACTION;

	-- fetch LORD card of the deck
	SELECT oldCardId = `cardId`, antifactId = `antifactId`
	FROM `player_decks`
	WHERE `playerId` = playerId
	AND		`deckId` = deckId
	AND 	`order` = 0;
	
	-- check whether the deck has a LORD card not not
	IF( IFNULL(oldCardId,0) = 0) THEN
		-- if not, add this card into the deck as a LORD
		INSERT INTO `player_decks`(`playerId`, `deckId`, `order`, `cardId`)
		VALUES(playerId, deckId, 0, cardId);
	ELSE
		-- otherwise, 
		-- 1, replace the LORD card
		UPDATE `player_decks`
		SET	`cardId` = cardId
		WHERE `playerId` = playerId
		AND `deckId` = deckId
		AND `order` = 0;
		
		-- 2, move the old one LORD back into player's cards collection
		-- -- check whether player own this card
		
		SELECT cardCount = COUNT(1)
		FROM `player_cards`
		WHERE `playerId` = playerId
		AND		`cardId` = oldCardId;
		
		IF( IFNULL(cardCount,0)>0) THEN
			-- if true, add the count of this card in player's cards collection
			UPDATE `player_cards`
			SET		`count` = IFNULL(`count`,0) + 1
			WHERE `playerId` = playerId
			AND		`cardId` = oldCardId;	
		ELSE
			-- otherwise, insert this card into player's cards collection
			INSERT INTO `player_cards` (`playerId`,`cardId`,`count`)
			VALUES(playerId,oldCardId,0);
		END IF;
		
		-- 3, check if this card has antifact
		IF( IFNULL(antifactId,0) > 0) THEN
			-- if true, move this antifact card back into player's cards collection
			SET cardCount = 0;
			
			SELECT cardCount = COUNT(1)
			FROM `player_cards`
			WHERE `playerId` = playerId
			AND		`cardId` = antifactId;
			
			IF( IFNULL(cardCount, 0)>0) THEN
				-- if true, add the count of this card into player's cards collection
				UPDATE `player_cards`
				SET		`count` = IFNULL(`count`, 0) + 1
				WHERE `playerId` = playerId
				AND		`cardId` = antifactId;	
			ELSE
				-- otherwise, insert this card into player's cards collection
				INSERT INTO `player_cards` (`playerId`, `cardId`, `count`)
				VALUES(playerId, antifactId, 0);
			END IF;
		END IF;
	END IF;
	
	-- remove this card from player's cards collection
	UPDATE `player_cards`
	SET		`count` =  CASE 
							WHEN IFNULL(`count`, 0) > 0 THEN `count` - 1
							ELSE 0 
						END
	WHERE `playerId` = playerId
	AND		`cardId` = cardId;	
	
	COMMIT;

END//