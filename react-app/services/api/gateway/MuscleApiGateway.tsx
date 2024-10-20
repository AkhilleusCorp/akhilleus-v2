import AbstractApiGateway from "app/services/api/gateway/AbstractApiGateway.tsx";
import MuscleDTO from "app/services/api/dtos/MuscleDTO.tsx";
import MusclesListFilters from "app/services/api/filters/MusclesListFilters.tsx";
import apiRoutes from "app/services/api/apiRoutes.tsx";
import QueryId from "app/utils/interfaces/QueryId.tsx";
import IndexedArray from "app/utils/interfaces/IndexedArray.tsx";
import APIResponseDTO from "app/services/api/dtos/APIResponseDTO.tsx";

class MuscleApiGateway extends AbstractApiGateway {
    static async getOneMuscle (muscleId: QueryId): Promise<MuscleDTO|null> {
        return this.getOne(apiRoutes.muscle.details(muscleId));
    }

    static async getManyMuscles (filters: MusclesListFilters): Promise<APIResponseDTO> {
        return this.getMany(apiRoutes.muscle.list, filters);
    }

    static async getDropdownableMuscles (): Promise<IndexedArray> {
        return this.getDropdownable(apiRoutes.muscle.dropdownable);
    }

    static async createMuscle (formData: unknown): Promise<MuscleDTO> {
        return this.createOne(apiRoutes.muscle.create, formData);
    }

    static async updateMuscle (muscleId: number, formData: unknown): Promise<MuscleDTO> {
        return this.updateOne(apiRoutes.muscle.update(muscleId), formData);
    }

    static async deleteMuscle (muscleId: QueryId): Promise<void> {
        return this.deleteOne(apiRoutes.muscle.delete(muscleId));
    }
}

export default MuscleApiGateway;