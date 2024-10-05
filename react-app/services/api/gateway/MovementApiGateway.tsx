import axios from "axios";
import AbstractApiGateway from "./AbstractApiGateway.tsx";
import MovementDTO from "../dtos/MovementDTO.tsx";
import MovementsListFilters from "../filters/MovementsListFilters.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";

class MovementApiGateway extends AbstractApiGateway {
    static async getOneMovement (movementId: QueryId): Promise<MovementDTO|null> {
        const response = await axios.get(apiRoutes.movement.details(movementId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async getManyMovements (filters: MovementsListFilters): Promise<MovementDTO[]> {
        const queryParams = this.objectToQueryParams(filters);
        const response = await axios.get(apiRoutes.movement.list+'?'+queryParams);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        if (response.data.data === undefined) {
            return [];
        }

        return response.data.data;
    }

    static async createMovement (formData: unknown): Promise<MovementDTO> {
        const response = await axios.post(
            apiRoutes.movement.create,
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async updateMovement (movementId: number, formData: unknown): Promise<MovementDTO> {
        const response = await axios.put(
            apiRoutes.movement.update(movementId),
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async deleteMovement (movementId: QueryId): Promise<void> {
        const response = await axios.delete(apiRoutes.movement.delete(movementId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }
    }
}

export default MovementApiGateway;