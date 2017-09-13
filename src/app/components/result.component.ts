import {Component, OnInit, ViewChild} from "@angular/core";
import {ActivatedRoute, Params, Router} from "@angular/router";
import {Observable} from "rxjs";
import {RestaurantService} from "../services/restaurant.service";
import {RestaurantViolationService} from "../services/restaurantViolation.service"
// import {}
// import from {Restaurant} from "../classes/restaurant";
import {Violation} from "../classes/violation";
import {RestaurantViolation} from "../classes/restaurantViolation";
import {Category} from "../classes/category";
import {Status} from "../classes/status";
import {ViolationService} from "../services/violation.service";
import {CategoryService} from "../services/category.service"
import "rxjs/add/operator/switchMap";
import {Restaurant} from "../classes/restaurant";


@Component({
	templateUrl: "./templates/result.html"
})
export class ResultComponent implements OnInit{
	restaurant : Restaurant = new Restaurant(null, null, null, null, null, null, null, null, null, null, null);
	restaurantViolation : RestaurantViolation = new RestaurantViolation(null, null, null, null, null, null, null);
	violation : Violation = new Violation(null, null, null, null);
	category : Category = new Category(null, null);
	restaurantViolations : RestaurantViolation[] = [];
	categories : Category[] = [];
	violations : Violation[] = [];
	status : Status = null;

	constructor(
		private categoryService : CategoryService,
		private restaurantService: RestaurantService,
		private restaurantViolationService: RestaurantViolationService,
		private violationService: ViolationService,
		private router: Router,
		private activatedRoute: ActivatedRoute,
		) {}
		ngOnInit() : void {
			this.getViolations();
			this.loadRestaurantAndViolation();
		}

		getViolations() : void {
		this.violationService.getAllViolations()
			.subscribe(violations => this.violations = violations)
		}
	loadRestaurantAndViolation() :void {
		this.activatedRoute.params.switchMap((params: Params)=> this.restaurantService.getRestaurantByRestaurantId(+params["id"])).subscribe(restaurant => {
			this.restaurant = restaurant;

			this.restaurantViolationService.getRestaurantViolationByRestaurantId(this.restaurant.restaurantId)
				.subscribe(restaurantViolations => this.restaurantViolations = restaurantViolations
					.filter(violation => violation.restaurantViolationCompliance === "OUT OF COMPLIANCE")
					.sort((left, right) => +right.restaurantViolationDate - +left.restaurantViolationDate)
					.splice(0, 25));
		});
	}

	getRestaurantViolation(restaurantViolation: RestaurantViolation) : string {
		return(this.violations.find(violation => violation.violationId === restaurantViolation.restaurantViolationViolationId).violationCodeDescription);
	}

}





