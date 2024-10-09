import {createAsyncThunk, createSlice, PayloadAction} from "@reduxjs/toolkit"
import EquipmentDTO from "../../api/dtos/EquipmentDTO.tsx";
import EquipmentListFilters from "../../api/filters/EquipmentsListFilters.tsx";
import EquipmentApiGateway from "../../api/gateway/EquipmentApiGateway.tsx";

export interface EquipmentInitialState {
    equipments: EquipmentDTO[],
    loading: boolean,
    error: string | null,
}

const initialState: EquipmentInitialState = {
    equipments: [],
    loading: false,
    error: null,
}

export const fetchEquipments = createAsyncThunk<EquipmentDTO[], EquipmentListFilters, { rejectValue: string}>(
    'equipments/fetchEquipments',
    async (filters: EquipmentListFilters, {rejectWithValue}) => {
        try {
            return EquipmentApiGateway.getManyEquipments(filters);
        } catch (error: any) {
            if (error.response && error.response.data.message) {
                return rejectWithValue(error.response.data.message);
            }
            return rejectWithValue('Failed to fetch equipments');
        }
    }
)

export const equipmentSlice = createSlice({
    name: 'equipment',
    initialState,
    reducers: {},
    extraReducers: builder => {
        builder.addCase(fetchEquipments.pending, (state: EquipmentInitialState) => {
            state.loading = true;
        })
        builder.addCase(fetchEquipments.rejected, (state: EquipmentInitialState, action: PayloadAction<string | undefined>) => {
            state.loading = false;
            state.error = action.payload || 'Unknown error';
        })
        builder.addCase(fetchEquipments.fulfilled, (state: EquipmentInitialState, action: PayloadAction<EquipmentDTO[]>) => {
            state.loading = false;
            state.equipments = action.payload;
        })
    }
})

export default equipmentSlice.reducer