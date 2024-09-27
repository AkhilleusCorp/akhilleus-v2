const USER_API_HOST = 'https://api.akhilleus.com:8000/api/users';
const WORKOUT_API_HOST = 'https://api.akhilleus.com:8000/api/workouts';

const apiRoutes = {
    user: {
        create: USER_API_HOST,
        list: USER_API_HOST,
        details: (userId: number|string) => `${USER_API_HOST}/${userId}`,
        update: (userId: number|string) => `${USER_API_HOST}/${userId}`,
        delete: (userId: number|string) => `${USER_API_HOST}/${userId}`,
    },
    workout: {
        create: WORKOUT_API_HOST,
        list: WORKOUT_API_HOST,
        details: (userId: number|string) => `${WORKOUT_API_HOST}/${userId}`,
        update: (userId: number|string) => `${WORKOUT_API_HOST}/${userId}`,
        delete: (userId: number|string) => `${WORKOUT_API_HOST}/${userId}`,
    },
}

export default apiRoutes;