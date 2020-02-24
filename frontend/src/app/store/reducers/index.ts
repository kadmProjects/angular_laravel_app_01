import {
    ActionReducer,
    ActionReducerMap,
    createFeatureSelector,
    createSelector,
    MetaReducer
} from '@ngrx/store';
import { environment } from '../../../environments/environment';
import * as fromPermission from './permission.reducer';
import { PermissionState } from './../permission_state';


export interface AppState {
    [fromPermission.permissionFeatureKey]: PermissionState;
}

export const reducers: ActionReducerMap<AppState> = {
    [fromPermission.permissionFeatureKey]: fromPermission.reducer,
};

export const metaReducers: MetaReducer<AppState>[] = !environment.production ? [] : [];