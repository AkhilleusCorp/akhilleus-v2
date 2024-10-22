import {configureStore} from "@reduxjs/toolkit";
import MuscleReducer from "app/common/services/redux/reducers/MuscleSlice.tsx";
import EquipmentReducer from "app/common/services/redux/reducers/EquipmentSlice.tsx";
import MovementReducer from "app/common/services/redux/reducers/MovementSlice.tsx";
import WorkoutReducer from "app/common/services/redux/reducers/WorkoutSlice.tsx";
import ExerciseGroupReducer from "app/common/services/redux/reducers/ExerciseGroupSlice.tsx";
import UserReducer from "app/common/services/redux/reducers/UserSlice.tsx";

export const adminStore = configureStore({
    reducer: {
        muscles: MuscleReducer,
        equipments: EquipmentReducer,
        movements: MovementReducer,
        workouts: WorkoutReducer,
        exerciseGroups: ExerciseGroupReducer,
        users: UserReducer,
    }
});

export type AdminRootState = ReturnType<typeof adminStore.getState>
export type AdminDispatch = typeof adminStore.dispatch