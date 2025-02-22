import {createAsyncThunk, createSlice, PayloadAction} from "@reduxjs/toolkit"
import WorkoutDTO from "app/common/services/api/dtos/WorkoutDTO.tsx";
import WorkoutApiGateway from "app/common/services/api/gateway/WorkoutApiGateway.tsx";
import PaginationDTO from "app/common/services/api/dtos/PaginationDTO.tsx";
import APIResponseDTO from "app/common/services/api/dtos/APIResponseDTO.tsx";
import AdminWorkoutListFilters from "app/admin/services/api/filters/AdminWorkoutsListFilters.tsx";
import MemberWorkoutsListFilters from "app/member/services/api/filters/MemberWorkoutsListFilters.tsx";

export interface WorkoutInitialState {
    workouts: WorkoutDTO[],
    pagination: PaginationDTO | null,
    loading: boolean,
    error: string | null,
}

const initialState: WorkoutInitialState = {
    workouts: [],
    pagination: null,
    loading: false,
    error: null,
}

export const fetchWorkouts = createAsyncThunk<APIResponseDTO, AdminWorkoutListFilters|MemberWorkoutsListFilters, { rejectValue: string}>(
    'workouts/fetchWorkouts',
    async (filters: AdminWorkoutListFilters|MemberWorkoutsListFilters, {rejectWithValue}) => {
        try {
            return WorkoutApiGateway.fetchManyWorkouts(filters);
        } catch (error: any) {
            if (error.response && error.response.data.message) {
                return rejectWithValue(error.response.data.message);
            }
            return rejectWithValue('Failed to fetch workouts');
        }
    }
)

export const workoutSlice = createSlice({
    name: 'workout',
    initialState,
    reducers: {},
    extraReducers: builder => {
        builder.addCase(fetchWorkouts.pending, (state: WorkoutInitialState) => {
            state.loading = true;
        })
        builder.addCase(fetchWorkouts.rejected, (state: WorkoutInitialState, action: PayloadAction<string | undefined>) => {
            state.loading = false;
            state.error = action.payload || 'Unknown error';
        })
        builder.addCase(fetchWorkouts.fulfilled, (state: WorkoutInitialState, action: PayloadAction<APIResponseDTO>) => {
            state.loading = false;
            state.workouts = action.payload.data;
            state.pagination = action.payload.extra.pagination;
        })
    }
})

export default workoutSlice.reducer