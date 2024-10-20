import AbstractApiGateway from "app/services/api/gateway/AbstractApiGateway.tsx";
import WorkoutDTO from "app/services/api/dtos/WorkoutDTO.tsx";
import WorkoutsListFilters from "app/services/api/filters/WorkoutsListFilters.tsx";
import apiRoutes from "app/services/api/apiRoutes.tsx";
import QueryId from "app/utils/interfaces/QueryId.tsx";
import APIResponseDTO from "app/services/api/dtos/APIResponseDTO.tsx";

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