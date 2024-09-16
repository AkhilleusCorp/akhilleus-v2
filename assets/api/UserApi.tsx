import axios from "axios";
import UserDTO from "../dtos/UserDTO.tsx";
import UsersListFilters from "../filters/UsersListFilters.tsx";

class UserAPI {
    private static host: string = 'https://api.akhilleus.com:8000/api/users';

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

        return response.data.data;
    }

    static async createUser (formData: any): Promise<UserDTO> {
        const response = await axios.post(
            this.host,
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

    static objectToQueryParams = (params: { [key: string]: any }) => {
        return new URLSearchParams(params).toString();
    };
}

export default UserAPI;