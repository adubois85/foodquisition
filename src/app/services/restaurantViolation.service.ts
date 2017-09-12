import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base.service";
import {RestaurantViolation} from "../classes/restaurantViolation";
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

	getRestaurantViolationByRestaurantId(id: number) : Observable<RestaurantViolation[]> {
		return(this.http.get( this.restaurantViolationUrl + id)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getRestaurantViolationComplianceByRestaurantName(restaurantViolationCompliance: string): Observable<RestaurantViolation[]> {
		return (this.http.get(this.restaurantViolationUrl + "? restaurantViolationCompliance" + restaurantViolationCompliance)
			.map(this.extractData)
			.catch(this.handleError));
	}
}