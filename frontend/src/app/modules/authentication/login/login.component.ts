import { logging } from 'protractor';
import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { AuthenticationService } from '../authentication.service';
import { AuthorizationService } from 'src/app/shared/services/authorization.service';
import { Router } from '@angular/router';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss'],
})
export class LoginComponent implements OnInit {

    loginForm: FormGroup;

    constructor(
        private authentication: AuthenticationService,
        private authorization: AuthorizationService,
        private router: Router
    ) { }

    ngOnInit() {
        this.createFormControls();
    }

    private createFormControls() {
        this.loginForm = new FormGroup({
            email: new FormControl('', [Validators.required, Validators.email]),
            password: new FormControl('', [Validators.required, Validators.minLength(8)])
        });
    }

    onSubmit() {
        if (this.loginForm.valid) {
            this.authentication.login(this.loginForm.value)
                .subscribe(
                    (data) => {
                        if (data.successStatus == 'success') {
                            console.log(data);
                            this.router.navigate(['/dashboard']);
                        } else if (data.successStatus == 'failed') {
                            console.log(data);
                        } else {
                            console.log(data);
                        }
                    },
                    error => {
                        console.log(error);
                    },
                    () => {
                        console.log('round completed');
                    }
                )
        }
    }

}
