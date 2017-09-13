export class RestaurantViolation {
	constructor(public restaurantViolationId: number, public restaurantViolationRestaurantId: number, public restaurantViolationViolationId: number, public restaurantViolationCompliance: string, public restaurantViolationDate: Date, public restaurantViolationMemo: string, public restaurantViolationResults: string) {}
}