import {configureStore} from "@reduxjs/toolkit";
import MuscleReducer from "app/admin/services/redux/reducers/MuscleSlice.tsx";
import EquipmentReducer from "app/admin/services/redux/reducers/EquipmentSlice.tsx";
import MovementReducer from "app/admin/services/redux/reducers/MovementSlice.tsx";
import WorkoutReducer from "app/admin/services/redux/reducers/WorkoutSlice.tsx";
import ExerciseGroupReducer from "app/admin/services/redux/reducers/ExerciseGroupSlice.tsx";
import UserReducer from "app/admin/services/redux/reducers/UserSlice.tsx";

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