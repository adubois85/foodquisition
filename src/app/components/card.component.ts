import {Component, OnInit, ViewChild} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {Observable} from "rxjs";
import {RestaurantService} from "../services/restaurant.service"
import {RestaurantViolationService} from "../services/restaurantViolation.service"
import {Restaurant} from "../classes/restaurant";
import {RestaurantViolation} from "../classes/restaurantViolation";
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/card.html"
})

export class CardComponent {
	@ViewChild("cardForm") cardForm : any;
	restaurantName: string = ""; // search term for restaurant-search
	restaurantResults: Restaurant[] = [];
	restaurantViolationResults: RestaurantViolation[] = [];

	status: Status = null;

	constructor(private restaurantService: RestaurantService, private restaurantViolationService: RestaurantViolationService) {}

	ngOnInit(): void {
		this.getRestaurantByName();

	}

	getRestaurantByName(): void {

		this.restaurantService.getRestaurantByName(this.restaurantName).subscribe(restaurants=>this.restaurantResults=restaurants);
	}


}
