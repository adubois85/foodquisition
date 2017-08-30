INSERT INTO category (categoryId, categoryName)
VALUES (1, "No manager present/knowledgable");

INSERT INTO category (categoryId, categoryName)
VALUES (2, "Employees working while sick");

INSERT INTO category (categoryId, categoryName)
VALUES (3, "Bad hygiene practices");

INSERT INTO category (categoryId, categoryName)
VALUES (4, "Potential contamination by hands");

INSERT INTO category (categoryId, categoryName)
VALUES (5, "Potential bad source/unsafe food");

INSERT INTO category (categoryId, categoryName)
VALUES (6, "Potential contamination");

INSERT INTO category (categoryId, categoryName)
VALUES (7, "Improper cook time, temps, dates");

INSERT INTO category (categoryId, categoryName)
VALUES (8, "Consumer advisories not posted");

INSERT INTO category (categoryId, categoryName)
VALUES (9, "Served at-risk pop unsafe foods");

INSERT INTO category (categoryId, categoryName)
VALUES (10, "Unsafe use of chemicals/additive");

INSERT INTO category (categoryId, categoryName)
VALUES (11, "Used unapproved food processing");

INSERT INTO category (categoryId, categoryName)
VALUES (12, "Unsafe eggs/water/processing");

INSERT INTO category (categoryId, categoryName)
VALUES (13, "Improper thawing or holding");

INSERT INTO category (categoryId, categoryName)
VALUES (14, "Food improperly labeled");

INSERT INTO category (categoryId, categoryName)
VALUES (15, "Possible infestation");

INSERT INTO category (categoryId, categoryName)
VALUES (16, "Improper use of utensils");

INSERT INTO category (categoryId, categoryName)
VALUES (17, "Unclean surfaces / facilities");

INSERT INTO category (categoryId, categoryName)
VALUES (18, "Facilities not up to code");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (1, 1, "1", "Person in charge was not on-site or failed to demonstrate knowledge of duties.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (2, 2, "2", "Person in charge failed to demonstrate employees are informed on reportable illnesses.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (3, 2, "3", "Observed or found evidence of an employee working, or having worked, while ill.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (4, 3, "4", "Observed evidence of employee food, open drinks, or tobacco use in food prep area.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (5, 3, "5", "Observed discharge from eyes, nose, or mouth.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (6, 4, "6", "Observed employees not washing hands correctly or as often as required.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (7, 4, "7", "Observed employees touching ready-to-eat foods with bare hands.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (8, 4, "8", "Observed hand washing sinks not properly stocked or conveniently located.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (9, 5, "9", "Observed person in charge is unable to determine approved source of food supplies.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (10, 5, "10", "	Discovered food temperatures were not taken upon receiving to verify compliance with food safety.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (11, 5, "11", "Observed food in poor condition, is unsafe, or is adulterated.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (12, 5, "12", "Observed lack of shell stock tags for shellfish or improper documentation of parasite destruction in fish.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (13, 6, "13", "Observed food improperly stored, packaged, covered, or lacking protection against contamination.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (14, 6, "14", "Observed ineffective methods of cleaning and sanitizing food-contact surfaces.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (15, 6, "15", "Observed food determined to be unsafe, adulterated, or contaminated.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (16, 7, "16", "Observed food items undercooked.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (17, 7, "17", "Observed food items improperly reheated.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (18, 7, "18", "Observed improper cooling time and temperatures of potentially hazardous foods.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (19, 7, "19", "Observed improper hot holding temperatures.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (20, 7, "20", "Observed improper cold holding temperatures of potentially hazardous foods.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (21, 7, "21", "Observed date-marked food exceeding time limit or date-marking is not followed.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (22, 7, "22", "Person in charge does not have a standard operating procedure in place to use time as a public health control while storing potentially hazardous foods outside of proper holding temperatures.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (23, 8, "23", "Observed raw or undercooked foods served or sold without a consumer advisory.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (24, 9, "24", "Observed facility serving unpasteurized foods, undercooked eggs, or prohibited foods to a highly susceptible population.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (25, 10, "25", "Observed unapproved additives on-site or approved additives used improperly.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (26, 10, "26", "Observed Toxic substances are not properly identified, stored, or used.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (27, 11, "27", "Observed unapproved specialized food process used or approved variance not followed.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (28, 12, "28", "Pasteurized eggs were not used where required.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (29, 12, "29", "Water and ice were not from an approved source.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (30, 12, "30", "Observed facility not following an approved variance for specialized processing method.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (31, 13, "31", "Observed improper cooling methods or inadequate equipment for temperature control.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (32, 13, "32", "Plant food not properly cooked for hot holding.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (33, 13, "33", "Observed use of unapproved thawing methods.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (34, 13, "34", "Observed food thermometers missing, inaccurate, or not easily accessible for use by employees.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (35, 14, "35", "Observed packaged food without appropriate labels.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (36, 15, "36", "Observed harborage, evidence, or presence of rodents, insects, and animals in facility.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (37, 15, "37", "Observed inadequate methods to prevent food contamination during food preparation, storage, and display.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (38, 15, "38", "Observed personnel without clean outer clothing, inappropriate hair restraint, using prohibited jewelry, or inappropriate fingernails.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (39, 15, "39", "Observed wiping cloths inappropriately stored, used, or held in improper sanitizer concentration.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (40, 15, "40", "Observed raw produce or fruit improperly washed.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (41, 16, "41", "Observed improper storage of in-use utensils during pauses in food preparation or dispensing.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (42, 16, "42", "Observed or assessed overall storage and handling of equipment and utensils is inappropriate.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (43, 16, "43", "Observed single-use / single service items improperly stored or used.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (44, 16, "44", "Observed single-use gloves misused or are contributing to cross-contamination.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (45, 17, "45", "Observed food and non-food contact surfaces improperly designed, constructed, installed, used, or not kept in good repair.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (46, 17, "46", "Observed facility is using improper ware washing or ineffective sanitization.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (47, 17, "47", "Observed improper cleaning method or inadequate cleaning frequency of non-food contact surfaces.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (48, 18, "48", "Observed hot and cold water is not available or is not at an adequate pressure.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (49, 18, "49", "Observed plumbing system has not been properly installed or is unprotected from contamination.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (50, 18, "50", "Observed sewage or wastewater system was incorrectly installed or is not functioning properly.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (51, 18, "51", "Observed toilet facilities are improperly constructed, supplied, or cleaned.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (52, 18, "52", "Observed refuse collection and disposal areas inadequately designed, installed, or maintained.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (53, 18, "53", "Observed facility inadequately cleaned, maintained, or in disrepair.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (54, 18, "54", "Observed inadequate ventilation, lighting, or storage of personal belongings.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (55, 18, "55", "Facility does not have a valid permit for operating within the city.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (56, 18, "56", "Due to an imminent health hazard or other conditions the inspector judges to be a substantial hazard to public health, the facility was immediately closed or its permit was suspended.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (57, 18, "57", "Violation(s) and associated correction action(s) are listed on this form.");

INSERT INTO violation (violationId, violationCategoryId, violationCode, violationCodeDescription)
VALUES (58, 18, "58", "Evidence was observed to substantiate complaint.");