import { Action, createReducer, on } from '@ngrx/store';
import { PermissionState } from './../permission_state';
import { permissionInitialState } from '../permission_initial_state';
import * as Permissions from './../actions/permission.actions';

export const permissionFeatureKey = 'permission';

const permissionReducer = createReducer(
    permissionInitialState,
    on(Permissions.grantSinglePermissionItem, (state, action) => ({
        ...state,
        [action.group] : {
            ...state[action.group],
            [action.subGroup] : {
                ...state[action.group][action.subGroup],
                [action.name]: action.authorize
            }
        }
    })),
    on(Permissions.grantDashboardPermissionItemGroup, (state, action) => ({
        ...state,
        dashboard: action.permission
    })),
    on(Permissions.grantUserPermissionItemGroup, (state, action) => ({
        ...state,
        user: action.permission
    })),
    on(Permissions.grantAllPermissionItems, (state, action) => ({
        ...state,
        state: [action.permission]
    }))
);

export function reducer(state: PermissionState | undefined, action: Action) {
    return permissionReducer(state, action);
}
