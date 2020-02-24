import { PermissionState } from './permission_state';

export const permissionInitialState: PermissionState = {
    dashboard: {
        sideNav: {
            viewUserNavBtn: false,
            viewUsersNavSubBtn: false,
            viewPermissionsNavSubBtn: false,
            viewEmployeeNavBtn: false,
            viewEmployeesNavSubBtn: false
        },
        topNav: {
            viewNotificationIcon: false,
            viewSearchBar: false
        }
    },
    user: {
        userMgt: {
            addUser: false,
            deleteUser: false,
            updateUser: false,
            viewUsers: false,
            viewUser: false
        },
        permissionMgt: {
            
        }
    },
};