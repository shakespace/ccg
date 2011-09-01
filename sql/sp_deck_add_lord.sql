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
		CALL `sp_player_cards_add`(playerId, oldCardId);
		
		-- 3, check if this card has antifact
		IF( IFNULL(antifactId,0) > 0) THEN
			-- if true, move this antifact card back into player's cards collection
			CALL `sp_player_cards_add`(playerId, antifactId);
		END IF;
	END IF;
	
	-- remove this card from player's cards collection
	CALL `sp_player_cards_discard`(playerId, cardId);
	
	COMMIT;

END//