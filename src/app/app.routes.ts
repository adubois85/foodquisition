import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home.component";
import {CardComponent} from "./components/card.component";
import {PostsComponent} from "./components/posts.component";

import {PostService} from "./services/post-service";

export const allAppComponents = [
	HomeComponent,
	CardComponent,
	PostsComponent
];

export const routes: Routes = [
	{path: "posts", component:PostsComponent},
	{path: "card", component:CardComponent},
	{path: "", component: HomeComponent},
	{path: "**", redirectTo: ""}
];

export const appRoutingProviders: any[] = [PostService];

export const routing = RouterModule.forRoot(routes);