import {createAsyncThunk, createSlice, PayloadAction} from "@reduxjs/toolkit"
import ExerciseGroupDTO from "app/services/api/dtos/ExerciseGroupDTO.tsx";
import ExerciseGroupApiGateway from "app/services/api/gateway/ExerciseGroupApiGateway.tsx";

export interface ExerciseGroupInitialState {
    exerciseGroups: ExerciseGroupDTO[],
    loading: boolean,
    error: string | null,
}

const initialState: ExerciseGroupInitialState = {
    exerciseGroups: [],
    loading: false,
    error: null,
}

export const fetchExerciseGroups = createAsyncThunk<ExerciseGroupDTO[], number, { rejectValue: string}>(
    'exerciseGroups/fetchExerciseGroups',
    async (workoutId, {rejectWithValue}) => {
        try {
            return ExerciseGroupApiGateway.getManyExerciseGroups(workoutId);
        } catch (error: any) {
            if (error.response && error.response.data.message) {
                return rejectWithValue(error.response.data.message);
            }
            return rejectWithValue('Failed to fetch exerciseGroups');
        }
    }
)

export const addExerciseGroup = createAsyncThunk<ExerciseGroupDTO, {workoutId: number, movementIds: number[]}, { rejectValue: string}>(
    'exerciseGroups/addExerciseGroup',
    async ({workoutId, movementIds}, {rejectWithValue}) => {
        try {
            return ExerciseGroupApiGateway.createOneExerciseGroup(workoutId, {movementIds: movementIds});
        } catch (error: any) {
            if (error.response && error.response.data.message) {
                return rejectWithValue(error.response.data.message);
            }
            return rejectWithValue('Failed to fetch exerciseGroups');
        }
    }
)

export const exerciseGroupSlice = createSlice({
    name: 'exerciseGroup',
    initialState,
    reducers: {},
    extraReducers: builder => {
        builder.addCase(fetchExerciseGroups.pending, (state: ExerciseGroupInitialState) => {
            state.loading = true;
        })
        builder.addCase(fetchExerciseGroups.rejected, (state: ExerciseGroupInitialState, action: PayloadAction<string | undefined>) => {
            state.loading = false;
            state.error = action.payload || 'Unknown error';
        })
        builder.addCase(fetchExerciseGroups.fulfilled, (state: ExerciseGroupInitialState, action: PayloadAction<ExerciseGroupDTO[]>) => {
            state.loading = false;
            state.exerciseGroups = action.payload;
        })
        builder.addCase(addExerciseGroup.pending, (state: ExerciseGroupInitialState) => {
            state.loading = true;
        })
        builder.addCase(addExerciseGroup.rejected, (state: ExerciseGroupInitialState, action: PayloadAction<string | undefined>) => {
            state.loading = false;
            state.error = action.payload || 'Unknown error';
        })
        builder.addCase(addExerciseGroup.fulfilled, (state: ExerciseGroupInitialState, action: PayloadAction<ExerciseGroupDTO>) => {
            state.loading = false;
            state.exerciseGroups.push(action.payload);
        })
    }
})

export default exerciseGroupSlice.reducer