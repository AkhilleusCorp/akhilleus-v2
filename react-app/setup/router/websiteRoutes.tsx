const websiteRoutes = {
    dashboard: '/admin',
    user: {
        list: '/admin/users',
        details: (userId: number|string) => `/admin/users/${userId}`,
        create: '/admin/users/new',
        edit: (userId: number|string) => `/admin/users/${userId}/edit`,
    },
    workout: {
        list: '/admin/workouts',
        details: (workoutId: number|string) => `/admin/workouts/${workoutId}`,
        create: '/admin/workouts/new',
        edit: (workoutId: number|string) => `/admin/workouts/${workoutId}/edit`,
    },
    equipment: {
        list: '/admin/equipments',
        details: (equipmentId: number|string) => `/admin/equipments/${equipmentId}`,
        create: '/admin/equipments/new',
        edit: (equipmentId: number|string) => `/admin/equipments/${equipmentId}/edit`,
    },
    logout: '/logout'
}

export default websiteRoutes;