import {configureStore} from "@reduxjs/toolkit";
import MuscleReducer from "./reducers/MuscleSlice.tsx";
import EquipmentReducer from "./reducers/EquipmentSlice.tsx";
import MovementReducer from "./reducers/MovementSlice.tsx";
import WorkoutReducer from "./reducers/WorkoutSlice.tsx";
import ExerciseGroupReducer from "./reducers/ExerciseGroupSlice.tsx";
import UserReducer from "./reducers/UserSlice.tsx";

export const store = configureStore({
    reducer: {
        muscles: MuscleReducer,
        equipments: EquipmentReducer,
        movements: MovementReducer,
        workouts: WorkoutReducer,
        exerciseGroups: ExerciseGroupReducer,
        users: UserReducer,
    }
});

export type RootState = ReturnType<typeof store.getState>
export type AppDispatch = typeof store.dispatch