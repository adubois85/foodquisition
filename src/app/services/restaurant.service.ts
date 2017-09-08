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

	private restaurantUrl = "apis/restaurant/";

	getRestaurantByName(restauarantName: string) : Observable<Restaurant[]> {
		return(this.http.get(this.restaurantUrl + restauarantName)
			.map(this.extractData)
			.catch(this.handleError));
	}



}