import { Observable, BehaviorSubject, of } from 'rxjs';
import { catchError, map } from 'rxjs/operators';
import { Injectable } from '@angular/core';
import { HttpHeaders, HttpClient } from '@angular/common/http';
import { Authentication } from './authentication';
import { environment } from './../../../environments/environment';
import { HttpErorHandlerService } from 'src/app/shared/services/http-eror-handler.service';

@Injectable({
  providedIn: 'root'
})

export class AuthenticationService {
    private _url = environment.API_URL;
    public isLoggedIn: BehaviorSubject<boolean> = new BehaviorSubject(false);
    redirectUrl: string;

    constructor(
        private http: HttpClient,
        private httpErrorMsg: HttpErorHandlerService
    ) { }

    public login(credentials: Authentication): Observable<any> {
        let targetUrl = this._url + 'login';
        let httpOptions = {
            headers: new HttpHeaders({
                'Content-Type':  'application/json'
            })
        };

        return this.http.post<any>(targetUrl, credentials, httpOptions)
            .pipe(
                map((data) => {
                    if (data.success) {
                        data = data.success;
                        let status = data.status;
                        let message = data.message;
                        if (status === '200' && message === 'UserAuthenticationSuccess') {
                            this.isLoggedIn.next(data.isLoggedIn);
                            data = data.data;
                            data.successStatus = 'success';

                            return data;
                        } else {
                            this.isLoggedIn.next(data.isLoggedIn);
                            data = {};
                            data.message = 'User authentication unsuccessfull. Unknown status and message.';
                            data.successStatus = 'unknown';
    
                            return data;
                        }
                    } else if (data.error) {
                        this.isLoggedIn.next(data.isLoggedIn);
                        data = data.error;
                        data.successStatus = 'failed';

                        return data;
                    } else {
                        this.isLoggedIn.next(data.isLoggedIn);
                        data = {};
                        data.message = 'User authentication unsuccessfull. Unknown status.';
                        data.successStatus = 'unknown';

                        return data;
                    }
                }),
                catchError(this.httpErrorMsg.handleError)
            );
    }

    public logout(): Observable<any> {
        let targetUrl = this._url + 'logout';
        let httpOptions = {
            headers: new HttpHeaders({
                'Content-Type':  'application/json'
            })
        };

        return this.http.post<any>(targetUrl, {withCredentials: true}, httpOptions)
            .pipe(
                catchError(this.httpErrorMsg.handleError)
            )
    }

    public getLoggedInStatus(url): Observable<any> {
        let targetUrl = this._url + 'loginStatus';
        let data = { currentUrl: url };
        let httpOptions = {
            headers: new HttpHeaders({
                'Content-Type':  'application/json'
            }),
            withCredentials: true
        };

        return this.http.post<any>(targetUrl, data, httpOptions)
            .pipe(
                map((data: any) => {
                    console.log('Auth servise', data);
                    if (data.success) {
                        data = data.success;
                        if (data.status == '200' && data.message == 'AuthenticatedUser') {
                            this.isLoggedIn.next(data.isLoggedIn);
                            data.successStatus = 'success';

                            return data;
                        } else {
                            data = {};
                            this.isLoggedIn.next(data.isLoggedIn);
                            data.message = 'Unauthenticated user. Unknown status and message.';
                            data.successStatus = 'unknown';

                            return data;
                        }
                    } else if (data.error) {
                        this.isLoggedIn.next(data.isLoggedIn);
                        data = data.error;
                        data.successStatus = 'failed';

                        return data;
                    } else {
                        data = {};
                        this.isLoggedIn.next(data.isLoggedIn);
                        data.message = 'User authentication unsuccessfull. Unknown status and message.';
                        data.successStatus = 'unknown';

                        return data;
                    }
                }),
                catchError(this.handleError)
            )
    }

    private handleError = (error: any) => {
        return of(error);
    }
}
