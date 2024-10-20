import AbstractApiGateway from "app/common/services/api/gateway/AbstractApiGateway.tsx";
import apiRoutes from "app/common/services/api/apiRoutes.tsx";
import QueryId from "app/common/utils/interfaces/QueryId.tsx";
import ExerciseGroupDTO from "app/admin/services/api/dtos/ExerciseGroupDTO.tsx";

class ExerciseApiGateway extends AbstractApiGateway {

    static async addExercisesToGroup (workoutId: QueryId, groupId: QueryId): Promise<ExerciseGroupDTO|null> {
        return this.patchOne(apiRoutes.exercise.addExercises(workoutId, groupId));
    }
}

export default ExerciseApiGateway;