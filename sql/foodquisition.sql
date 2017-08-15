
-- these statements will drop the tables re-add them
DROP TABLE IF EXISTS restaurantViolation;
DROP TABLE IF EXISTS violation;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS restaurant;

--  these statements will create the tables
CREATE TABLE restaurant (
	restaurantId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	restaurantAddress1 VARCHAR(128) NOT NULL,
	restaurantAddress2 VARCHAR(128),
	restaurantCity VARCHAR(64) NOT NULL,
	restaurantFacilityKey VARCHAR(7) NOT NULL,
	restaurantGoogleId VARCHAR(128),
	restaurantName VARCHAR(64) NOT NULL,
	restaurantPhoneNumber VARCHAR(32),
	restaurantState CHAR (2) NOT NULL,
	restaurantType VARCHAR(64) NOT NULL,
	restaurantZip VARCHAR(10) NOT NULL,
	UNIQUE (restaurantFacilityKey),
	INDEX (restaurantGoogleId),
	INDEX (restaurantName),
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
	restaurantViolationCompliance VARCHAR(17),
	restaurantViolationDate DATE NOT NULL,
	restaurantViolationMemo VARCHAR(255),
	restaurantViolationResults VARCHAR(32) NOT NULL,
	INDEX (restaurantViolationRestaurantId),
	INDEX (restaurantViolationViolationId),
	FOREIGN KEY (restaurantViolationRestaurantId) REFERENCES restaurant(restaurantId),
	FOREIGN KEY (restaurantViolationViolationId) REFERENCES violation(violationId),
	PRIMARY KEY (restaurantViolationId)
);