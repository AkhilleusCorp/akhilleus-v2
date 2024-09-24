import axios from "axios";
import WorkoutDTO from "../dtos/WorkoutDTO.tsx";
import WorkoutsListFilters from "../filters/WorkoutsListFilters.tsx";
import AbstractAPI from "./AbstractAPI.tsx";

class WorkoutAPI extends AbstractAPI {
    private static host = 'https://api.akhilleus.com:8000/api/workouts';

    static async getOneWorkout (workoutId: string|number): Promise<WorkoutDTO|null> {
        const response = await axios.get(this.host +'/' + workoutId);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async getManyWorkouts (filters: WorkoutsListFilters): Promise<WorkoutDTO[]> {
        const queryParams = this.objectToQueryParams(filters);
        const response = await axios.get(this.host+'?'+queryParams);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async createWorkout (formData: unknown): Promise<WorkoutDTO> {
        const response = await axios.post(
            this.host,
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async updateWorkout (workoutId: number, formData: unknown): Promise<WorkoutDTO> {
        const response = await axios.put(
            this.host + '/' + workoutId,
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async deleteWorkout (workoutId: string|number): Promise<void> {
        const response = await axios.delete(this.host +'/' + workoutId);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }
    }
}

export default WorkoutAPI;