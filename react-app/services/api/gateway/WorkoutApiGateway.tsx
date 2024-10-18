import AbstractApiGateway from "./AbstractApiGateway.tsx";
import WorkoutDTO from "../dtos/WorkoutDTO.tsx";
import WorkoutsListFilters from "../filters/WorkoutsListFilters.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";
import APIResponseDTO from "../dtos/APIResponseDTO.tsx";

class WorkoutApiGateway extends AbstractApiGateway {
    static async getOneWorkout (workoutId: QueryId): Promise<WorkoutDTO|null> {
        return this.getOne(apiRoutes.workout.details(workoutId));
    }

    static async getManyWorkouts (filters: WorkoutsListFilters): Promise<APIResponseDTO> {
        return this.getMany(apiRoutes.workout.list, filters);
    }

    static async createWorkout (formData: unknown): Promise<WorkoutDTO> {
        return this.createOne(apiRoutes.workout.create, formData);
    }

    static async updateWorkout (workoutId: number, formData: unknown): Promise<WorkoutDTO> {
        return this.updateOne(apiRoutes.workout.update(workoutId), formData);
    }

    static async deleteWorkout (workoutId: QueryId): Promise<void> {
        return this.deleteOne(apiRoutes.workout.delete(workoutId));
    }
}

export default WorkoutApiGateway;