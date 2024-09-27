import axios from "axios";
import UserDTO from "../dtos/UserDTO.tsx";
import UsersListFilters from "../filters/UsersListFilters.tsx";
import AbstractAPI from "./AbstractAPI.tsx";

class UserAPI extends AbstractAPI {
    private static host = 'https://api.akhilleus.com:8000/api/users';

    static async getOneUser (userId: string|number): Promise<UserDTO|null> {
        const response = await axios.get(this.host +'/' + userId);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async getManyUsers (filters: UsersListFilters): Promise<UserDTO[]> {
        const queryParams = this.objectToQueryParams(filters);
        const response = await axios.get(this.host+'?'+queryParams);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        if (response.data.data === undefined) {
            return [];
        }

        return response.data.data;
    }

    static async createUser (formData: unknown): Promise<UserDTO> {
        const response = await axios.post(
            this.host,
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async updateUser (userId: number, formData: unknown): Promise<UserDTO> {
        const response = await axios.put(
            this.host + '/' + userId,
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async deleteUser (userId: string|number): Promise<void> {
        const response = await axios.delete(this.host +'/' + userId);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }
    }
}

export default UserAPI;