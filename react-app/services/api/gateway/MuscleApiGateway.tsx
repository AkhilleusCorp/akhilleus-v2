import AbstractApiGateway from "./AbstractApiGateway.tsx";
import MuscleDTO from "../dtos/MuscleDTO.tsx";
import MusclesListFilters from "../filters/MusclesListFilters.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";
import IndexedArray from "../../../utils/interfaces/IndexedArray.tsx";

class MuscleApiGateway extends AbstractApiGateway {
    static async getOneMuscle (muscleId: QueryId): Promise<MuscleDTO|null> {
        return this.getOne(apiRoutes.muscle.details(muscleId));
    }

    static async getManyMuscles (filters: MusclesListFilters): Promise<MuscleDTO[]> {
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