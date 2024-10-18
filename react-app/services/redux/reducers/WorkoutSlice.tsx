import {createAsyncThunk, createSlice, PayloadAction} from "@reduxjs/toolkit"
import WorkoutDTO from "../../api/dtos/WorkoutDTO.tsx";
import WorkoutListFilters from "../../api/filters/WorkoutsListFilters.tsx";
import WorkoutApiGateway from "../../api/gateway/WorkoutApiGateway.tsx";
import PaginationDTO from "../../api/dtos/PaginationDTO.tsx";
import APIResponseDTO from "../../api/dtos/APIResponseDTO.tsx";

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

export const fetchWorkouts = createAsyncThunk<APIResponseDTO, WorkoutListFilters, { rejectValue: string}>(
    'workouts/fetchWorkouts',
    async (filters: WorkoutListFilters, {rejectWithValue}) => {
        try {
            return WorkoutApiGateway.getManyWorkouts(filters);
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