import AbstractApiGateway from "app/common/services/api/gateway/AbstractApiGateway.tsx";
import MovementDTO from "app/admin/services/api/dtos/MovementDTO.tsx";
import MovementsListFilters from "app/admin/services/api/filters/MovementsListFilters.tsx";
import apiRoutes from "app/common/services/api/apiRoutes.tsx";
import QueryId from "app/common/utils/interfaces/QueryId.tsx";
import IndexedArray from "app/common/utils/interfaces/IndexedArray.tsx";
import APIResponseDTO from "app/common/services/api/dtos/APIResponseDTO.tsx";

class MovementApiGateway extends AbstractApiGateway {
    static async getOneMovement (movementId: QueryId): Promise<MovementDTO|null> {
        return this.getOne(apiRoutes.movement.details(movementId));
    }

    static async getManyMovements (filters: MovementsListFilters): Promise<APIResponseDTO> {
        return this.getMany(apiRoutes.movement.list, filters);
    }

    static async getDropdownableMovements (): Promise<IndexedArray> {
        return this.getDropdownable(apiRoutes.movement.dropdownable);
    }

    static async createMovement (formData: unknown): Promise<MovementDTO> {
        return this.createOne(apiRoutes.movement.create, formData);
    }

    static async updateMovement (movementId: number, formData: unknown): Promise<MovementDTO> {
        return this.updateOne(apiRoutes.movement.update(movementId), formData);
    }

    static async deleteMovement (movementId: QueryId): Promise<void> {
        return this.deleteOne(apiRoutes.movement.delete(movementId));
    }
}

export default MovementApiGateway;