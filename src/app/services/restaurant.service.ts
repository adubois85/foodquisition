import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base.service";
import {Restaurant} from "../classes/restaurant";
import {Status} from "../classes/status";

@Injectable()
export class RestaurantService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private restaurantUrl = "api/restaurant/";

	getRestaurantByName(restaurantName: string): Observable<Restaurant[]> {
		return (this.http.get(this.restaurantUrl + "?restaurantName=" + restaurantName)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getRestaurantByRestaurantId(restaurantId: number ): Observable<Restaurant> {
		return (this.http.get(this.restaurantUrl + "?id=" + restaurantId)
			.map(this.extractData)
			.catch(this.handleError));


		//public_html/api/restaurant/?restaurantName=tacobell

	}
}