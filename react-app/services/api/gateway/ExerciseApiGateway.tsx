import AbstractApiGateway from "./AbstractApiGateway.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";
import ExerciseGroupDTO from "../dtos/ExerciseGroupDTO.tsx";

class ExerciseApiGateway extends AbstractApiGateway {

    static async addExercisesToGroup (workoutId: QueryId, groupId: QueryId): Promise<ExerciseGroupDTO|null> {
        return this.patchOne(apiRoutes.exercise.addExercises(workoutId, groupId));
    }
}

export default ExerciseApiGateway;