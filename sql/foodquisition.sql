CREATE TABLE restaurant (
	restaurantAddress VARCHAR(128) NOT NULL,
	restaurantFacilityKey CHAR(7) NOT NULL,
	restaurantGoogleId VARCHAR(128),
	restaurantId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	restaurantName VARCHAR(64) NOT NULL,
	restaurantPhoneNumber VARCHAR(32),
	restaurantType VARCHAR(64),
	UNIQUE (restaurantFacilityKey),
	UNIQUE (restaurantGoogleId),
	UNIQUE (restaurantId),
	PRIMARY KEY (restaurantId)
);

CREATE TABLE category(

);

CREATE TABLE violation(

);

CREATE TABLE restaurantviolation(

);