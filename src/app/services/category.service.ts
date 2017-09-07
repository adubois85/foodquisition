import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base.service";
import {Category} from "../classes/category";
import {Status} from "../classes/status";

@Injectable()
export class CategoryService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private categoryUrl = "apis/category/";

	getAllCategories() : Observable<Category[]> {
		return(this.http.get(this.categoryUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getCategoryByCategoryId(categoryId : number) : Observable<Category> {
		return(this.http.get(this.categoryUrl + categoryId)
			.map(this.extractData)
			.catch(this.handleError));
	}

}