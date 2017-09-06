import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Restaurant} from "../classes/restaurant";
import {Status} from "../classes/status";

@Injectable()
export class RestaurantService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private postUrl = "apis/post/";

	getAllRestaurants() : Observable<Restaurant[]> {
		return(this.http.get(this.postUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getRestaurantByRestaurantName(RestaurantId : number) : Observable<Restaurant> {
		return(this.http.get(this.postUrl + RestaurantId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createPost(post : Restaurant) : Observable<Status> {
		return(this.http.post(this.postUrl, post)
			.map(this.extractMessage)
			.catch(this.handleError));
	}
}