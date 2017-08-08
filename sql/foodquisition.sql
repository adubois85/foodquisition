CREATE TABLE restaurant (
	restaurantId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	restaurantAddress1 VARCHAR(128) NOT NULL,
	restaurantAddress2 VARCHAR(128),
	restaurantCity VARCHAR(64) NOT NULL,
	restaurantFacilityKey CHAR(7) NOT NULL,
	restaurantGoogleId VARCHAR(128),
	restaurantName VARCHAR(64) NOT NULL,
	restaurantPhoneNumber VARCHAR(32),
	restaurantState CHAR (2) NOT NULL,
	restaurantType VARCHAR(64),
	restaurantZip VARCHAR(10) NOT NULL,
	UNIQUE (restaurantFacilityKey),
	INDEX (restaurantGoogleId),
	PRIMARY KEY (restaurantId)
);

CREATE TABLE category(
	categoryId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	categoryName VARCHAR(32),
	PRIMARY KEY (categoryId)
);

CREATE TABLE violation(
	violationId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	violationCategoryId INT UNSIGNED NOT NULL,
	violationCode VARCHAR(8) NOT NULL,
	violationCodeDescription VARCHAR(255) NOT NULL,
	FOREIGN KEY (violationCategoryId) REFERENCES category(categoryId),
	PRIMARY KEY (violationId)
);

CREATE TABLE restaurantViolation(
	restaurantViolationId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	restaurantViolationRestaurantId INT UNSIGNED NOT NULL,
	restaurantViolationViolationId INT UNSIGNED NOT NULL,
	restaurantViolationDate DATE NOT NULL,
	restaurantViolationMemo VARCHAR(255),
	restaurantViolationResults VARCHAR(32) NOT NULL,
	FOREIGN KEY (restaurantViolationRestaurantId) REFERENCES restaurant(restaurantId),
	FOREIGN KEY (restaurantViolationViolationId) REFERENCES violation(violationId),
	PRIMARY KEY (restaurantViolationId)
);