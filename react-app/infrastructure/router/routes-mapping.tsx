const routes = {
    dashboard: '/admin',
    userList: '/admin/users',
    userDetails: (userId: number|string) => `/admin/users/${userId}`,
    userCreate: '/admin/users/new',
    userEdit: (userId: number|string) => `/admin/users/${userId}/edit`,
    logout: '/logout'
}

export default routes;