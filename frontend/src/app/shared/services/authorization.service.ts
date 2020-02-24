import { Injectable } from '@angular/core';
import { Store } from '@ngrx/store';
import { AppState } from './../../store/reducers';
import { 
    PermissionState,
    DashboardPermissionState,
    UserPermissionState
} from './../../store/permission_state';

import { 
    grantSinglePermissionItem,
    grantDashboardPermissionItemGroup,
    grantUserPermissionItemGroup,
    grantAllPermissionItems
} from './../../store/actions/permission.actions';

@Injectable({
    providedIn: 'root'
})

export class AuthorizationService {

    constructor(
        private store: Store<{ appState: AppState}>
    ) { }

    public setSinglePermissionItem(
        group: string,
        subGroup: string,
        name: string,
        authorize: boolean
    ) {
        this.store.dispatch(grantSinglePermissionItem({
            group: group,
            subGroup: subGroup,
            name: name,
            authorize: authorize
        }))
    }

    public setDashboardPermissionItems(data: DashboardPermissionState) {
        this.store.dispatch(grantDashboardPermissionItemGroup({ permission: data }));
    }

    public setUserPermissionItems(data: UserPermissionState) {
        this.store.dispatch(grantUserPermissionItemGroup({ permission: data }));
    }

    public setAllPermissionItems(data: PermissionState) {
        this.store.dispatch(grantAllPermissionItems({ permission: data }));
    }
}
