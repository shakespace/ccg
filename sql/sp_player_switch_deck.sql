DROP PROCEDURE IF EXISTS `sp_player_switch_deck`//

CREATE PROCEDURE `sp_player_switch_deck`(
	IN playerId INT,
	IN deckId INT
)
BEGIN

	UPDATE `player`
	SET `defaultDeck` = deckId
	WHERE `id` = playerId;

END//