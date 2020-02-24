import { NgModule, APP_INITIALIZER } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AuthenticationModule } from './modules/authentication/authentication.module';
import { MaterialModule } from './shared/modules/material/material.module';
import { LayoutsModule } from './shared/modules/layouts/layouts.module';
import { StoreModule } from '@ngrx/store';
import { reducers, metaReducers } from './store/reducers';
import { StoreDevtoolsModule } from '@ngrx/store-devtools';
import { environment } from './../environments/environment';
import { EffectsModule } from '@ngrx/effects';
import { AppEffects } from './store/effects/app.effects';
import { PermissionEffects } from './store/effects/permission.effects';
import { AuthGuard } from './shared/guards/auth.guard';
import { AppService } from './shared/services/app.service';
import { ErrorsModule } from './shared/modules/errors/errors.module';

export function app_init(appService: AppService) {
    return () => appService.initializeApp();
}

@NgModule({
    declarations: [
        AppComponent
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        BrowserAnimationsModule,
        AuthenticationModule,
        MaterialModule,
        LayoutsModule,
        ErrorsModule,
        HttpClientModule,
        StoreModule.forRoot(reducers, {
            metaReducers, 
            runtimeChecks: {
                strictStateImmutability: true,
                strictActionImmutability: true,
            }
        }),
        !environment.production ? StoreDevtoolsModule.instrument() : [],
        EffectsModule.forRoot([AppEffects, PermissionEffects])
    ],
    providers: [
        AuthGuard,
        AppService,
        {
            provide: APP_INITIALIZER, useFactory: app_init, deps: [AppService], multi: true
        }
    ],
    bootstrap: [AppComponent]
})
export class AppModule { }
