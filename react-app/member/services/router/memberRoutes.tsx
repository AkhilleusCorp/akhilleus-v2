const memberRoutes = {
    dashboard: '/member',
    workout: {
        list: '/member/workouts',
        details: (workoutId: number|string) => `/member/workouts/${workoutId}`,
        create: '/member/workouts/new',
        edit: (workoutId: number|string) => `/member/workouts/${workoutId}/edit`,
    },
    logout: '/logout'
}

export default memberRoutes;