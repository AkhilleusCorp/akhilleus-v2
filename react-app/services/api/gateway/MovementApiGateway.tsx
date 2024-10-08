import AbstractApiGateway from "./AbstractApiGateway.tsx";
import MovementDTO from "../dtos/MovementDTO.tsx";
import MovementsListFilters from "../filters/MovementsListFilters.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";
import IndexedArray from "../../../utils/interfaces/IndexedArray.tsx";

class MovementApiGateway extends AbstractApiGateway {
    static async getOneMovement (movementId: QueryId): Promise<MovementDTO|null> {
        return this.getOne(apiRoutes.movement.details(movementId));
    }

    static async getManyMovements (filters: MovementsListFilters): Promise<MovementDTO[]> {
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