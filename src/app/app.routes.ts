import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home.component";
import {AboutComponent} from "./components/about.component";
import {PostsComponent} from "./components/posts.component";
import {NavbarComponent} from "./components/navbar.component";
import {FooterComponent} from "./components/footer.component";
import {PostService} from "./services/post-service";

export const allAppComponents = [
	HomeComponent,
	AboutComponent,
	PostsComponent,
	NavbarComponent,
	FooterComponent
];

export const routes: Routes = [
	{path: "posts", component:PostsComponent},
	{path: "about", component:AboutComponent},
	{path: "", component: HomeComponent},
	{path: "**", redirectTo: ""}
];

export const appRoutingProviders: any[] = [PostService];

export const routing = RouterModule.forRoot(routes);