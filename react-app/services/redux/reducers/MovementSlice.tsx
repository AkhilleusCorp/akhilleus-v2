import {createAsyncThunk, createSlice, PayloadAction} from "@reduxjs/toolkit"
import MovementDTO from "../../api/dtos/MovementDTO.tsx";
import MovementListFilters from "../../api/filters/MovementsListFilters.tsx";
import MovementApiGateway from "../../api/gateway/MovementApiGateway.tsx";

export interface MovementInitialState {
    movements: MovementDTO[],
    loading: boolean,
    error: string | null,
}

const initialState: MovementInitialState = {
    movements: [],
    loading: false,
    error: null,
}

export const fetchMovements = createAsyncThunk<MovementDTO[], MovementListFilters, { rejectValue: string}>(
    'movements/fetchMovements',
    async (filters: MovementListFilters, {rejectWithValue}) => {
        try {
            return MovementApiGateway.getManyMovements(filters);
        } catch (error: any) {
            if (error.response && error.response.data.message) {
                return rejectWithValue(error.response.data.message);
            }
            return rejectWithValue('Failed to fetch movements');
        }
    }
)

export const movementSlice = createSlice({
    name: 'movement',
    initialState,
    reducers: {},
    extraReducers: builder => {
        builder.addCase(fetchMovements.pending, (state: MovementInitialState) => {
            state.loading = true;
        })
        builder.addCase(fetchMovements.rejected, (state: MovementInitialState, action: PayloadAction<string | undefined>) => {
            state.loading = false;
            state.error = action.payload || 'Unknown error';
        })
        builder.addCase(fetchMovements.fulfilled, (state: MovementInitialState, action: PayloadAction<MovementDTO[]>) => {
            state.loading = false;
            state.movements = action.payload;
        })
    }
})

export default movementSlice.reducer