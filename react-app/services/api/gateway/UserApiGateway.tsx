import AbstractApiGateway from "./AbstractApiGateway.tsx";
import UserDTO from "../dtos/UserDTO.tsx";
import apiRoutes from "../apiRoutes.tsx";
import UsersListFilters from "../filters/UsersListFilters.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";

class UserApiGateway extends AbstractApiGateway {
    static async getOneUser (userId: QueryId): Promise<UserDTO|null> {
        return this.getOne(apiRoutes.user.details(userId));
    }

    static async getManyUsers (filters: UsersListFilters): Promise<UserDTO[]> {
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