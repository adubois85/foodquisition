<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Conceptual Model</title>
	</head>
	<body>
		<h1>Conceptual Model</h1>
		<h3>Restaurant</h3>
		<ul>
			<li>restaurantId(primaryKey)</li>
			<li>restaurantName</li>
			<li>restaurantFacilityKey</li>
			<li>restaurantCategory</li>
			<li>restaurantAddress</li>
			<li>restaurantPhoneNumber</li>
			<li>restaurantGoogleId</li>
		</ul>
		<h3>Violation</h3>
		<ul>
			<li>violationId(primaryKey)</li>
			<li>violationCode</li>
			<li>violationCodeDescription</li>
		</ul>
		<h3>RestaurantViolation</h3>
		<ul>
			<li>restaurantViolationId(primaryKey)</li>
			<li>restaurantViolationRestaurantId(foreignKey)</li>
			<li>restaurantViolationViolationId(foreignKey)</li>
			<li>restaurantViolationMemo</li>
			<li>restaurantViolationResult</li>
		</ul>
	</body>
</html>