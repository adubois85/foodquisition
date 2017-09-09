import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home.component";
import {CardComponent} from "./components/card.component";
import {ResultComponent} from "./components/result.component"


export const allAppComponents = [
	HomeComponent,
	CardComponent,
	ResultComponent
];

export const routes: Routes = [
	{path: "result", component:ResultComponent},
	{path: "card", component:CardComponent},
	{path: "", component: HomeComponent},
	{path: "**", redirectTo: ""}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);