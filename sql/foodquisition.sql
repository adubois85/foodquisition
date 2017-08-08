CREATE TABLE restaurant (
	restaurantAddress1 VARCHAR(128) NOT NULL,
	restaurantAddress2 VARCHAR(128),
	restaurantCity VARCHAR(64) NOT NULL,
	restaurantZip VARCHAR(10) NOT NULL,
	restaurantState CHAR (2) NOT NULL,
	restaurantFacilityKey CHAR(7) NOT NULL,
	restaurantGoogleId VARCHAR(128),
	restaurantId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	restaurantName VARCHAR(64) NOT NULL,
	restaurantPhoneNumber VARCHAR(32),
	restaurantType VARCHAR(64),
	UNIQUE (restaurantFacilityKey),
	UNIQUE (restaurantGoogleId),
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
	restaurantViolationDate DATE NOT NULL,
	restaurantViolationId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	restaurantViolationMemo VARCHAR(256),
	restaurantViolationRestaurantId INT UNSIGNED NOT NULL,
	restaurantViolationResults VARCHAR(32) NOT NULL,
	restaurantViolationViolationId INT UNSIGNED NOT NULL,
	UNIQUE (restaurantViolationId),
	FOREIGN KEY (restaurantViolationRestaurantId) REFERENCES restaurant(restaurantId),
	FOREIGN KEY (restaurantViolationViolationId) REFERENCES violation(violationId),
	PRIMARY KEY (restaurantViolationId)
);