import {createAsyncThunk, createSlice, PayloadAction} from "@reduxjs/toolkit"
import EquipmentDTO from "app/services/api/dtos/EquipmentDTO.tsx";
import EquipmentListFilters from "app/services/api/filters/EquipmentsListFilters.tsx";
import EquipmentApiGateway from "app/services/api/gateway/EquipmentApiGateway.tsx";
import APIResponseDTO from "app/services/api/dtos/APIResponseDTO.tsx";
import PaginationDTO from "app/services/api/dtos/PaginationDTO.tsx";

export interface EquipmentInitialState {
    equipments: EquipmentDTO[],
    pagination: PaginationDTO | null,
    loading: boolean,
    error: string | null,
}

const initialState: EquipmentInitialState = {
    equipments: [],
    pagination: null,
    loading: false,
    error: null,
}

export const fetchEquipments = createAsyncThunk<APIResponseDTO, EquipmentListFilters, { rejectValue: string}>(
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
        builder.addCase(fetchEquipments.fulfilled, (state: EquipmentInitialState, action: PayloadAction<APIResponseDTO>) => {
            state.loading = false;
            state.equipments = action.payload.data;
            state.pagination = action.payload.extra.pagination;
        })
    }
})

export default equipmentSlice.reducer