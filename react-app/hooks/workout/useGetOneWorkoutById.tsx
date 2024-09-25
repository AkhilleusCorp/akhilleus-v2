import WorkoutDTO from "../../dtos/WorkoutDTO.tsx";
import {useEffect, useState} from "react";
import WorkoutAPI from "../../api/WorkoutApi.tsx";

function useGetOneWorkoutById(workoutId: string|undefined): WorkoutDTO | null {
    if (!workoutId) {
        return null;
    }

    const [workout, setWorkout] = useState<WorkoutDTO | null>(null);
    useEffect(() => {
        const fetchWorkout = async () => {
            const workout = await WorkoutAPI.getOneWorkout(workoutId);
            setWorkout(workout);
        }

        fetchWorkout();
    }, [workoutId]);

    return workout;
}

export default useGetOneWorkoutById;