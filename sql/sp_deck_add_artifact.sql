DROP PROCEDURE IF EXISTS `sp_deck_add_artifact`//

CREATE PROCEDURE `sp_deck_add_artifact`(
	IN playerId INT,
	IN deckId INT,
	IN cardId INT,
	IN cardOrder INT,
	IN artifactId INT
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
	
	START TRANSACTION;
	
	-- add artifact to deck card at the position equals cardOrder
	UPDATE `player_decks`
	SET	`artifactId` = artifactId
	WHERE `playerId` = playerId
	AND	`deckId` = deckId
	AND `order` = cardOrder;
	
	-- dicard this artifact card from player's cards collection
	CALL `sp_player_cards_discard`(playerId, artifactId);
	
	COMMIT;

END//