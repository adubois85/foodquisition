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
	categoryId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	categoryName VARCHAR(32),
	UNIQUE (categoryId),
	PRIMARY KEY (categoryId)
);

CREATE TABLE violation(
	violationCategoryId INT UNSIGNED NOT NULL,
	violationCode VARCHAR(8) NOT NULL,
	violationCodeDescription VARCHAR(256) NOT NULL,
	violationId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	UNIQUE (violationId),
	FOREIGN KEY (violationCategoryId) REFERENCES category(categoryId),
	PRIMARY KEY (violationId)
);

CREATE TABLE restaurantviolation(

);