import axios from "axios";
import AbstractApiGateway from "./AbstractApiGateway.tsx";
import MuscleDTO from "../dtos/MuscleDTO.tsx";
import MusclesListFilters from "../filters/MusclesListFilters.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";
import IndexedArray from "../../../utils/interfaces/IndexedArray.tsx";

class MuscleApiGateway extends AbstractApiGateway {
    static async getOneMuscle (muscleId: QueryId): Promise<MuscleDTO|null> {
        const response = await axios.get(apiRoutes.muscle.details(muscleId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async getManyMuscles (filters: MusclesListFilters): Promise<MuscleDTO[]> {
        const queryParams = this.objectToQueryParams(filters);
        const response = await axios.get(apiRoutes.muscle.list+'?'+queryParams);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        if (response.data.data === undefined) {
            return [];
        }

        return response.data.data;
    }

    static async getDropdownableMuscles (): Promise<IndexedArray> {
        const response = await axios.get(apiRoutes.muscle.dropdownable);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async createMuscle (formData: unknown): Promise<MuscleDTO> {
        const response = await axios.post(
            apiRoutes.muscle.create,
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async updateMuscle (muscleId: number, formData: unknown): Promise<MuscleDTO> {
        const response = await axios.put(
            apiRoutes.muscle.update(muscleId),
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async deleteMuscle (muscleId: QueryId): Promise<void> {
        const response = await axios.delete(apiRoutes.muscle.delete(muscleId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }
    }
}

export default MuscleApiGateway;