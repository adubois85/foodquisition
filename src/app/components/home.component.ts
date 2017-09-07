import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {Observable} from "rxjs";
import {RestaurantService} from "../services/restaurant.service"
import {Restaurant} from "../classes/restaurant"
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/home.html"
})

export class HomeComponent {

	resstaurants : Restaurant[] = [];
	status : Status = null;

	constructor(protected restaurantService: RestaurantService) {}

	ngOnInit() : void {
		this.getRestaurant();
	}
}
