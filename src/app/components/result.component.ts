import {Component, Input, OnInit, ViewChild} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {Observable} from "rxjs";
import {RestaurantService} from "../services/restaurant.service";
import {Restaurant} from "../classes/restaurant";
import {Violation} from "../classes/violation";
import {RestaurantViolation} from "../classes/restaurantViolation";
import {Category} from "../classes/category";
import {Status} from "../classes/status";


@Component({
	templateUrl: "./templates/result.html"
})
export class ResultComponent implements OnInit {
	@ViewChild("cardForm") cardForm : any;
	restaurantName: string = ""; // search term for restaurant-search
	restaurantResults: Restaurant[] = [];
	status: Status = null;

	constructor(protected restaurantService: RestaurantService) {}

	ngOnInit(): void {
		this.getRestaurantByName();
	}

	getRestaurantByName(): void {

		this.restaurantService.getRestaurantByName(this.restaurantName).subscribe(restaurants=>this.restaurantResults=restaurants);
	}
	getRestaurantViolationCompliance(): void{

	}
}


