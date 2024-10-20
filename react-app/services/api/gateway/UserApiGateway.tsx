import AbstractApiGateway from "app/services/api/gateway/AbstractApiGateway.tsx";
import UserDTO from "app/services/api/dtos/UserDTO.tsx";
import apiRoutes from "app/services/api/apiRoutes.tsx";
import UsersListFilters from "app/services/api/filters/UsersListFilters.tsx";
import QueryId from "app/utils/interfaces/QueryId.tsx";
import APIResponseDTO from "app/services/api/dtos/APIResponseDTO.tsx";

class UserApiGateway extends AbstractApiGateway {
    static async getOneUser (userId: QueryId): Promise<UserDTO|null> {
        return this.getOne(apiRoutes.user.details(userId));
    }

    static async getManyUsers (filters: UsersListFilters): Promise<APIResponseDTO> {
        return this.getMany(apiRoutes.user.list, filters);
    }

    static async createUser (formData: unknown): Promise<UserDTO> {
        return this.createOne(apiRoutes.user.create, formData);
    }

    static async updateUser (userId: number, formData: unknown): Promise<UserDTO> {
        return this.updateOne(apiRoutes.user.update(userId), formData);
    }

    static async deleteUser (userId: QueryId): Promise<void> {
        return this.deleteOne(apiRoutes.user.delete(userId));
    }
}

export default UserApiGateway;