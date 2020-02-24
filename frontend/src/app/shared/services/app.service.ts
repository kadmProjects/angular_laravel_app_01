import { Injectable, Injector } from '@angular/core';
import { AuthenticationService } from './../../modules/authentication/authentication.service';
import { Router } from '@angular/router';
import { Location } from '@angular/common';

@Injectable({
    providedIn: 'root'
})
export class AppService {

    constructor(
        private injector: Injector
    ) { }

    public initializeApp(): Promise<any> {
        let url = this.injector.get(Location).path();

        if (url.search('login') === -1) {
            return new Promise(((resolve, reject) => {
            this.injector.get(AuthenticationService).getLoggedInStatus(url)
                .toPromise()
                .then(
                    (res) => {
                        console.log('App service res', res);
                        return res;
                    },
                    (error) => {
                        console.log('App service error', error);
                    }
                )
            }))
        }     
    }
}
