import QueryId from "../../utils/interfaces/QueryId.tsx";

const USER_API_HOST = 'https://api.akhilleus.com:8000/api/users';
const WORKOUT_API_HOST = 'https://api.akhilleus.com:8000/api/workouts';
const EQUIPMENT_API_HOST = 'https://api.akhilleus.com:8000/api/equipments';

const apiRoutes = {
    user: {
        create: USER_API_HOST,
        list: USER_API_HOST,
        details: (userId: QueryId) => `${USER_API_HOST}/${userId}`,
        update: (userId: QueryId) => `${USER_API_HOST}/${userId}`,
        delete: (userId: QueryId) => `${USER_API_HOST}/${userId}`,
    },
    workout: {
        create: WORKOUT_API_HOST,
        list: WORKOUT_API_HOST,
        details: (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}`,
        update: (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}`,
        delete: (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}`,
    },
    exerciseGroup: {
        list: (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups`,
        addExercises: (workoutId: QueryId, groupId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups/${groupId}/exercises`,
        delete: (workoutId: QueryId, groupId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups/${groupId}`,
    },
    equipment: {
        create: EQUIPMENT_API_HOST,
        list: EQUIPMENT_API_HOST,
        details: (equipmentId: QueryId) => `${EQUIPMENT_API_HOST}/${equipmentId}`,
        update: (equipmentId: QueryId) => `${EQUIPMENT_API_HOST}/${equipmentId}`,
        delete: (equipmentId: QueryId) => `${EQUIPMENT_API_HOST}/${equipmentId}`,
    },
}

export default apiRoutes;