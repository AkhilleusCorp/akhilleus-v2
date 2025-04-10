import QueryId from "app/common/utils/types/QueryId.tsx";

const API_HOST = 'akhilleus.com';
const EQUIPMENT_API_HOST = `https://${API_HOST}/api/equipments`;
const MOVEMENT_API_HOST = `https://${API_HOST}/api/movements`;
const MUSCLE_API_HOST = `https://${API_HOST}/api/muscles`;
const USER_API_HOST = `https://${API_HOST}/api/users`;
const WORKOUT_API_HOST = `https://${API_HOST}/api/workouts`;

const apiRoutes = {
    user: {
        create: `${USER_API_HOST}/create`,
        list: `${USER_API_HOST}/fetch`,
        details: (userId: QueryId) => `${USER_API_HOST}/${userId}/fetch`,
        update: (userId: QueryId) => `${USER_API_HOST}/${userId}/update`,
        delete: (userId: QueryId) => `${USER_API_HOST}/${userId}/delete`,
    },
    workout: {
        create: `${WORKOUT_API_HOST}/create`,
        list: `${WORKOUT_API_HOST}/fetch`,
        details: (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/fetch`,
        update: (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/update`,
        start: (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/start`,
        delete: (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/delete`,
    },
    exerciseGroup: {
        create:  (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups/create`,
        list: (workoutId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups/fetch`,
        delete: (workoutId: QueryId, groupId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups/${groupId}/delete`,
    },
    exercise: {
        addExercises: (workoutId: QueryId, groupId: QueryId) => `${WORKOUT_API_HOST}/${workoutId}/groups/${groupId}/exercises`,
    },
    equipment: {
        create: `${EQUIPMENT_API_HOST}/create`,
        list: `${EQUIPMENT_API_HOST}/fetch`,
        dropdownable:`${EQUIPMENT_API_HOST}/dropdownable`,
        details: (equipmentId: QueryId) => `${EQUIPMENT_API_HOST}/${equipmentId}/fetch`,
        update: (equipmentId: QueryId) => `${EQUIPMENT_API_HOST}/${equipmentId}/update`,
        delete: (equipmentId: QueryId) => `${EQUIPMENT_API_HOST}/${equipmentId}/delete`,
    },
    muscle: {
        create: `${MUSCLE_API_HOST}/create`,
        list: `${MUSCLE_API_HOST}/fetch`,
        dropdownable:`${MUSCLE_API_HOST}/dropdownable`,
        details: (muscleId: QueryId) => `${MUSCLE_API_HOST}/${muscleId}/fetch`,
        update: (muscleId: QueryId) => `${MUSCLE_API_HOST}/${muscleId}/update`,
        delete: (muscleId: QueryId) => `${MUSCLE_API_HOST}/${muscleId}/delete`,
    },
    movement: {
        create: `${MOVEMENT_API_HOST}/create`,
        list: `${MOVEMENT_API_HOST}/fetch`,
        dropdownable:`${MOVEMENT_API_HOST}/dropdownable`,
        details: (movementId: QueryId) => `${MOVEMENT_API_HOST}/${movementId}/fetch`,
        update: (movementId: QueryId) => `${MOVEMENT_API_HOST}/${movementId}/update`,
        delete: (movementId: QueryId) => `${MOVEMENT_API_HOST}/${movementId}/delete`,
    },
}

export default apiRoutes;