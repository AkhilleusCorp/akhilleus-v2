import QueryId from "../../utils/interfaces/QueryId.tsx";

const EQUIPMENT_API_HOST = 'https://api.akhilleus.com/api/equipments';
const MOVEMENT_API_HOST = 'https://api.akhilleus.com/api/movements';
const MUSCLE_API_HOST = 'https://api.akhilleus.com/api/muscles';
const USER_API_HOST = 'https://api.akhilleus.com/api/users';
const WORKOUT_API_HOST = 'https://api.akhilleus.com/api/workouts';

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
        create:  (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups`,
        list: (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups`,
        delete: (workoutId: QueryId, groupId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups/${groupId}`,
    },
    exercise: {
        addExercises: (workoutId: QueryId, groupId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups/${groupId}/exercises`,
    },
    equipment: {
        create: EQUIPMENT_API_HOST,
        list: EQUIPMENT_API_HOST,
        dropdownable:`${EQUIPMENT_API_HOST}/dropdownable`,
        details: (equipmentId: QueryId) => `${EQUIPMENT_API_HOST}/${equipmentId}`,
        update: (equipmentId: QueryId) => `${EQUIPMENT_API_HOST}/${equipmentId}`,
        delete: (equipmentId: QueryId) => `${EQUIPMENT_API_HOST}/${equipmentId}`,
    },
    muscle: {
        create: MUSCLE_API_HOST,
        list: MUSCLE_API_HOST,
        dropdownable:`${MUSCLE_API_HOST}/dropdownable`,
        details: (muscleId: QueryId) => `${MUSCLE_API_HOST}/${muscleId}`,
        update: (muscleId: QueryId) => `${MUSCLE_API_HOST}/${muscleId}`,
        delete: (muscleId: QueryId) => `${MUSCLE_API_HOST}/${muscleId}`,
    },
    movement: {
        create: MOVEMENT_API_HOST,
        list: MOVEMENT_API_HOST,
        dropdownable:`${MOVEMENT_API_HOST}/dropdownable`,
        details: (movementId: QueryId) => `${MOVEMENT_API_HOST}/${movementId}`,
        update: (movementId: QueryId) => `${MOVEMENT_API_HOST}/${movementId}`,
        delete: (movementId: QueryId) => `${MOVEMENT_API_HOST}/${movementId}`,
    },
}

export default apiRoutes;