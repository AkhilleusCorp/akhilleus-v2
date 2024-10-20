import AbstractApiGateway from "app/services/api/gateway/AbstractApiGateway.tsx";
import apiRoutes from "app/services/api/apiRoutes.tsx";
import QueryId from "app/utils/interfaces/QueryId.tsx";
import ExerciseGroupDTO from "app/services/api/dtos/ExerciseGroupDTO.tsx";

class ExerciseApiGateway extends AbstractApiGateway {

    static async addExercisesToGroup (workoutId: QueryId, groupId: QueryId): Promise<ExerciseGroupDTO|null> {
        return this.patchOne(apiRoutes.exercise.addExercises(workoutId, groupId));
    }
}

export default ExerciseApiGateway;