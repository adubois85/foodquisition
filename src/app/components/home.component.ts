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

	restaurantName: string = ""; // search term for restaurant-search
	restaurantResults: Restaurant[] = [];
	status: Status = null;

	constructor(protected restaurantService: RestaurantService) {}

	ngOnInit(): void {
		this.getRestaurantByName();
	}

	getRestaurantByName(): void {

		this.restaurantService.getRestaurantByName(this.restaurantName).subscribe(restaurants=>this.restaurantResults=restaurant);
	}
}

