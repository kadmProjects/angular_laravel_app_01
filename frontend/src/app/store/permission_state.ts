export interface PermissionState {
    dashboard: DashboardPermissionState,
    user: UserPermissionState
}

export interface DashboardPermissionState {
    sideNav: {
        viewUserNavBtn: boolean,
        viewUsersNavSubBtn: boolean,
        viewPermissionsNavSubBtn: boolean,
        viewEmployeeNavBtn: boolean,
        viewEmployeesNavSubBtn: boolean
    },
    topNav: {
        viewNotificationIcon: boolean,
        viewSearchBar: boolean
    }
}

export interface UserPermissionState {
    userMgt: {
        addUser: boolean,
        deleteUser: boolean,
        updateUser: boolean,
        viewUsers: boolean,
        viewUser: boolean
    },
    permissionMgt: {
        
    }
}