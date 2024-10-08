import axios from "axios";
import AbstractApiGateway from "./AbstractApiGateway.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";
import ExerciseGroupDTO from "../dtos/ExerciseGroupDTO.tsx";

class ExerciseApiGateway extends AbstractApiGateway {

    static async addExercisesToGroup (workoutId: QueryId, groupId: QueryId): Promise<ExerciseGroupDTO|null> {
        const response = await axios.patch(apiRoutes.exercise.addExercises(workoutId, groupId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }
}

export default ExerciseApiGateway;