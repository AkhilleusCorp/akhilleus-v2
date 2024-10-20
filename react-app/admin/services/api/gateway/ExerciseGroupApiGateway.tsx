import AbstractApiGateway from "app/common/services/api/gateway/AbstractApiGateway.tsx";
import apiRoutes from "app/common/services/api/apiRoutes.tsx";
import QueryId from "app/common/utils/interfaces/QueryId.tsx";
import ExerciseGroupDTO from "app/admin/services/api/dtos/ExerciseGroupDTO.tsx";
import axios from "axios";

class ExerciseGroupApiGateway extends AbstractApiGateway {

    static async getManyExerciseGroups (workoutId: QueryId): Promise<ExerciseGroupDTO[]> {
        const response = await axios.get(apiRoutes.exerciseGroup.list(workoutId));
        return response.data.data;
    }

    static async createOneExerciseGroup (workoutId: QueryId, formData: unknown): Promise<ExerciseGroupDTO> {
        const response = await axios.post(apiRoutes.exerciseGroup.create(workoutId), formData);
        return response.data.data;

    }

    static async deleteExerciseGroup (workoutId: QueryId, groupId: QueryId): Promise<void> {
        return this.deleteOne(apiRoutes.exerciseGroup.delete(workoutId, groupId));
    }
}

export default ExerciseGroupApiGateway;