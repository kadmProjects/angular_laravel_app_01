import { createAction, props } from '@ngrx/store';
import {
    PermissionState,
    DashboardPermissionState,
    UserPermissionState
} from './../permission_state';

export const grantSinglePermissionItem = createAction(
    'Grant Single Permission',
    props<{ group: string, subGroup: string, name: string, authorize: boolean }>()
);

export const grantDashboardPermissionItemGroup = createAction(
    'Grant Dashboard Permission Group',
    props<{ permission: DashboardPermissionState }>()
);

export const grantUserPermissionItemGroup = createAction(
    'Grant User Permission Group',
    props<{ permission: UserPermissionState }>()
);

export const grantAllPermissionItems = createAction(
    'Grant User Permission Group',
    props<{ permission: PermissionState }>()
);
