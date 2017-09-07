import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {Observable} from "rxjs";
import {RestaurantService} from "../services/restaurant.service"
import {Restaurant} from "../classes/restaurant"
import {Status} from "../classes/status";
import {RestaurantViolation} from "../classes/restaurantViolation";

@Component({
	templateUrl: "./templates/card.html"
})

export class CardComponent {}
