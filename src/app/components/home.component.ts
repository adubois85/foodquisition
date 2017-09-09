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

	constructor(private restaurantService: RestaurantService) {}

	ngOnInit(): void {

	}

	getRestaurantByName(name : string): void {

		this.restaurantService.getRestaurantByName(name).subscribe(restaurants=>this.restaurantResults=restaurants);
	}
}

