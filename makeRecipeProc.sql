CREATE DEFINER=`root`@`localhost` PROCEDURE `createPost`(IN `inRecipeName` VARCHAR(255), IN `inPostBody` TEXT)
BEGIN	
DECLARE result VARCHAR(255);		
INSERT													
INTO	recipe	(description,	name,	username)
VALUES	(inPostBody, inRecipeName,'user');									
SET	result	= 'Recipe created!';	
SELECT result;
END