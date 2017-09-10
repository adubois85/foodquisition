import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base.service";
import {RestaurantViolation} from "../classes/RestaurantViolation";
import {Status} from "../classes/status";


@Injectable()
export class RestaurantViolationService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private restaurantViolationUrl = "api/restaurantViolation/";

	getAllRestaurantViolations(): Observable<RestaurantViolation[]> {
		return (this.http.get(this.restaurantViolationUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getRestaurantViolationByRestaurantViolationId(restaurantViolationId: number): Observable<RestaurantViolation[]> {
		return (this.http.get(this.restaurantViolationUrl + restaurantViolationId)
			.map(this.extractData)
			.catch(this.handleError));
	}
}