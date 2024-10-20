import {createAsyncThunk, createSlice, PayloadAction} from "@reduxjs/toolkit"
import UserDTO from "app/services/api/dtos/UserDTO.tsx";
import UserListFilters from "app/services/api/filters/UsersListFilters.tsx";
import UserApiGateway from "app/services/api/gateway/UserApiGateway.tsx";
import PaginationDTO from "app/services/api/dtos/PaginationDTO.tsx";
import APIResponseDTO from "app/services/api/dtos/APIResponseDTO.tsx";

export interface UserInitialState {
    users: UserDTO[],
    pagination: PaginationDTO | null,
    loading: boolean,
    error: string | null,
}

const initialState: UserInitialState = {
    users: [],
    pagination: null,
    loading: false,
    error: null,
}

export const fetchUsers = createAsyncThunk<APIResponseDTO, UserListFilters, { rejectValue: string}>(
    'users/fetchUsers',
    async (filters: UserListFilters, {rejectWithValue}) => {
        try {
            return UserApiGateway.getManyUsers(filters);
        } catch (error: any) {
            if (error.response && error.response.data.message) {
                return rejectWithValue(error.response.data.message);
            }
            return rejectWithValue('Failed to fetch users');
        }
    }
)

export const userSlice = createSlice({
    name: 'user',
    initialState,
    reducers: {},
    extraReducers: builder => {
        builder.addCase(fetchUsers.pending, (state: UserInitialState) => {
            state.loading = true;
        })
        builder.addCase(fetchUsers.rejected, (state: UserInitialState, action: PayloadAction<string | undefined>) => {
            state.loading = false;
            state.error = action.payload || 'Unknown error';
        })
        builder.addCase(fetchUsers.fulfilled, (state: UserInitialState, action: PayloadAction<APIResponseDTO>) => {
            state.loading = false;
            state.users = action.payload.data;
            state.pagination = action.payload.extra.pagination;
        })
    }
})

export default userSlice.reducer