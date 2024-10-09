import {configureStore} from "@reduxjs/toolkit";
import EquipmentReducer from "./reducers/EquipmentSlice.tsx";
import ExerciseGroupReducer from "./reducers/ExerciseGroupSlice.tsx";

export const store = configureStore({
    reducer: {
        equipments: EquipmentReducer,
        exerciseGroups: ExerciseGroupReducer
    }
});

export type RootState = ReturnType<typeof store.getState>
export type AppDispatch = typeof store.dispatch