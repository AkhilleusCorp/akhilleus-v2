import axios from "axios";
import WorkoutDTO from "../dtos/WorkoutDTO.tsx";
import WorkoutsListFilters from "../filters/WorkoutsListFilters.tsx";
import AbstractAPI from "./AbstractAPI.tsx";
import apiRoutes from "../config/routes/api-routes.tsx";

class WorkoutAPI extends AbstractAPI {
    static async getOneWorkout (workoutId: string|number): Promise<WorkoutDTO|null> {
        const response = await axios.get(apiRoutes.workout.details(workoutId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async getManyWorkouts (filters: WorkoutsListFilters): Promise<WorkoutDTO[]> {
        const queryParams = this.objectToQueryParams(filters);
        const response = await axios.get(apiRoutes.workout.list+'?'+queryParams);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        if (response.data.data === undefined) {
            return [];
        }

        return response.data.data;
    }

    static async createWorkout (formData: unknown): Promise<WorkoutDTO> {
        const response = await axios.post(
            apiRoutes.workout.create,
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async updateWorkout (workoutId: number, formData: unknown): Promise<WorkoutDTO> {
        const response = await axios.put(
            apiRoutes.workout.update(workoutId),
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async deleteWorkout (workoutId: string|number): Promise<void> {
        const response = await axios.delete(apiRoutes.workout.delete(workoutId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }
    }
}

export default WorkoutAPI;