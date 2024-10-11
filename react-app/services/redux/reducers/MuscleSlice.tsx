import {createAsyncThunk, createSlice, PayloadAction} from "@reduxjs/toolkit"
import MuscleDTO from "../../api/dtos/MuscleDTO.tsx";
import MuscleListFilters from "../../api/filters/MusclesListFilters.tsx";
import MuscleApiGateway from "../../api/gateway/MuscleApiGateway.tsx";

export interface MuscleInitialState {
    muscles: MuscleDTO[],
    loading: boolean,
    error: string | null,
}

const initialState: MuscleInitialState = {
    muscles: [],
    loading: false,
    error: null,
}

export const fetchMuscles = createAsyncThunk<MuscleDTO[], MuscleListFilters, { rejectValue: string}>(
    'muscles/fetchMuscles',
    async (filters: MuscleListFilters, {rejectWithValue}) => {
        try {
            return MuscleApiGateway.getManyMuscles(filters);
        } catch (error: any) {
            if (error.response && error.response.data.message) {
                return rejectWithValue(error.response.data.message);
            }
            return rejectWithValue('Failed to fetch muscles');
        }
    }
)

export const muscleSlice = createSlice({
    name: 'muscle',
    initialState,
    reducers: {},
    extraReducers: builder => {
        builder.addCase(fetchMuscles.pending, (state: MuscleInitialState) => {
            state.loading = true;
        })
        builder.addCase(fetchMuscles.rejected, (state: MuscleInitialState, action: PayloadAction<string | undefined>) => {
            state.loading = false;
            state.error = action.payload || 'Unknown error';
        })
        builder.addCase(fetchMuscles.fulfilled, (state: MuscleInitialState, action: PayloadAction<MuscleDTO[]>) => {
            state.loading = false;
            state.muscles = action.payload;
        })
    }
})

export default muscleSlice.reducer