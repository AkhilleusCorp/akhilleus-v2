import AbstractApiGateway from "./AbstractApiGateway.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";
import ExerciseGroupDTO from "../dtos/ExerciseGroupDTO.tsx";

class ExerciseGroupApiGateway extends AbstractApiGateway {

    static async getManyExerciseGroups (workoutId: QueryId): Promise<ExerciseGroupDTO[]> {
        return this.getMany(apiRoutes.exerciseGroup.list(workoutId), null);
    }

    static async createOneExerciseGroup (workoutId: QueryId, formData: unknown): Promise<ExerciseGroupDTO> {
        return this.createOne(apiRoutes.exerciseGroup.create(workoutId), formData);
    }

    static async deleteExerciseGroup (workoutId: QueryId, groupId: QueryId): Promise<void> {
        return this.deleteOne(apiRoutes.exerciseGroup.delete(workoutId, groupId));
    }
}

export default ExerciseGroupApiGateway;