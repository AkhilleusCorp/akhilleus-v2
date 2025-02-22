import AbstractApiGateway from "app/common/services/api/gateway/AbstractApiGateway.tsx";
import WorkoutDTO from "app/common/services/api/dtos/WorkoutDTO.tsx";
import AdminWorkoutsListFilters from "app/admin/services/api/filters/AdminWorkoutsListFilters.tsx";
import apiRoutes from "app/common/services/api/apiRoutes.tsx";
import QueryId from "app/common/utils/types/QueryId.tsx";
import APIResponseDTO from "app/common/services/api/dtos/APIResponseDTO.tsx";
import MemberWorkoutsListFilters from "app/member/services/api/filters/MemberWorkoutsListFilters.tsx";

class WorkoutApiGateway extends AbstractApiGateway {
    static async fetchOneWorkout (workoutId: QueryId): Promise<WorkoutDTO|null> {
        return this.fetchOne(apiRoutes.workout.details(workoutId));
    }

    static async fetchManyWorkouts (filters: AdminWorkoutsListFilters|MemberWorkoutsListFilters): Promise<APIResponseDTO> {
        return this.fetchMany(apiRoutes.workout.list, filters);
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