import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {Observable} from "rxjs";
import {RestaurantService} from "../services/restaurant.service"
import {Restaurant} from "../classes/restaurant"
import {Status} from "../classes/status";
import {Subject} from "rxjs/Subject";

@Component({
	templateUrl: "./templates/home.html"
})

export class HomeComponent {

	searchNameStream = new Subject <string>();
	searchName: string = ""; // search term for restaurant-search
	restaurantResults: Restaurant[] = [];
	status: Status = null;

	constructor(private restaurantService: RestaurantService) {
		this.searchNameStream.subscribe(name=>this.getRestaurantByName(name));
	}

	ngOnInit(): void {

	}

	getRestaurantByName(name : string): void {

		this.restaurantService.getRestaurantByName(name)
			.debounceTime(5000)
			.distinctUntilChanged()
			.subscribe(restaurants=>this.restaurantResults=restaurants);
	}
}

