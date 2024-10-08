import axios from "axios";
import AbstractApiGateway from "./AbstractApiGateway.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";
import ExerciseGroupDTO from "../dtos/ExerciseGroupDTO.tsx";

class ExerciseGroupApiGateway extends AbstractApiGateway {

    static async getManyExerciseGroups (workoutId: QueryId): Promise<ExerciseGroupDTO[]> {
        const response = await axios.get(apiRoutes.exerciseGroup.list(workoutId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        if (response.data.data === undefined) {
            return [];
        }

        return response.data.data;
    }

    static async createOneExerciseGroup (workoutId: QueryId, formData: unknown): Promise<ExerciseGroupDTO> {
        const response = await axios.post(
            apiRoutes.exerciseGroup.create(workoutId),
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async deleteExerciseGroup (workoutId: QueryId, groupId: QueryId): Promise<void> {
        const response = await axios.delete(apiRoutes.exerciseGroup.delete(workoutId, groupId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }
    }
}

export default ExerciseGroupApiGateway;