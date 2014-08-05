CREATE DEFINER=`root`@`localhost` PROCEDURE `login`(IN `inUsername` VARCHAR(255), IN `inPass` VARCHAR(255))
BEGIN
DECLARE realUN VARCHAR(255);
DECLARE result VARCHAR(255);


SELECT realName
	FROM users
        WHERE username = inUsername
        AND hashed_password = hex(inPass)
        LIMIT 1
        INTO realUN;
   
IF realUN IS NULL THEN
	SET result = 'Invalid credentials';
ELSE
	SET result = '000';
        END IF;
        SELECT result;
        END