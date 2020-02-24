import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './modules/authentication/login/login.component';
import { NavbarComponent } from './shared/modules/layouts/navbar/navbar.component';
import { AuthGuard } from './shared/guards/auth.guard';
import { InvalidRouteComponent } from './shared/modules/errors/invalid-route/invalid-route.component';

const routes: Routes = [
    { 
        path: 'login', component: LoginComponent
    },
    {
        path: '',
        redirectTo: 'dashboard',
        pathMatch: 'full'
    },
    {
        path: 'dashboard',
        component: NavbarComponent,
        canActivate: [AuthGuard]
    },
    {
        path: '**',
        component: InvalidRouteComponent
    }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule { }
