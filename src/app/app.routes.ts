import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home.component";
import {CardComponent} from "./components/card.component";
import {ResultComponent} from "./components/result.component"
import {RestaurantService} from "./services/restaurant.service";
import {CategoryService} from "./services/category.service";
import {RestaurantViolationService} from "./services/restaurantViolation.service";
import {ViolationService} from "./services/violation.service";
import {APP_BASE_HREF} from "@angular/common";



export const allAppComponents = [
	HomeComponent,
	CardComponent,
	ResultComponent
];

export const routes: Routes = [
	{path: "result/:id", component:ResultComponent},
	{path: "card", component:CardComponent},
	{path: "", component: HomeComponent},
	{path: "**", redirectTo: ""}
];

export const appRoutingProviders: any[] = [{provide: APP_BASE_HREF, useValue: window["_base_href"]}, RestaurantService, CategoryService, RestaurantViolationService, ViolationService
];

export const routing = RouterModule.forRoot(routes); 