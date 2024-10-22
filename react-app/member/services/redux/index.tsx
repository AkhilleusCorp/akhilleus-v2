import {configureStore} from "@reduxjs/toolkit";
import WorkoutReducer from "app/common/services/redux/reducers/WorkoutSlice.tsx";

export const memberStore = configureStore({
    reducer: {
        workouts: WorkoutReducer,
    }
});

export type MemberRootState = ReturnType<typeof memberStore.getState>
export type MemberDispatch = typeof memberStore.dispatch