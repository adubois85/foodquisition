import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Violation} from "../classes/violation";
import {Status} from "../classes/status";

@Injectable()
export class ViolationService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private violationUrl = "apis/violation/";

	getAllViolations() : Observable<Violation[]> {
		return(this.http.get(this.violationUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getViolationViolationId(violationId : number) : Observable<Violation> {
		return(this.http.get(this.violationUrl + violationId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	createPost(violation : Violation) : Observable<Status> {
		return(this.http.post(this.violationUrl, violation)
			.map(this.extractMessage)
			.catch(this.handleError));
	}
}