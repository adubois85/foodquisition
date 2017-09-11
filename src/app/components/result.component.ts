import {Component, Input, OnInit, ViewChild} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {Observable} from "rxjs";
import {RestaurantService} from "../services/restaurant.service";
import {RestaurantViolationService} from "../services/restaurantViolation.service"
// import {}
// import from {Restaurant} from "../classes/restaurant";
import {Violation} from "../classes/violation";
import {RestaurantViolation} from "../classes/restaurantViolation";
import {Category} from "../classes/category";
import {Status} from "../classes/status";


@Component({
	templateUrl: "./templates/result.html"
})
export class ResultComponent {}



