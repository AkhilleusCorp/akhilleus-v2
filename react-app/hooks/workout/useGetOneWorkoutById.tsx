import {useEffect, useState} from "react";
import WorkoutApiGateway from "../../api/gateway/WorkoutApiGateway.tsx";
import WorkoutDTO from "../../api/dtos/WorkoutDTO.tsx";

function useGetOneWorkoutById(workoutId: string|undefined): WorkoutDTO | null {
    if (!workoutId) {
        return null;
    }

    const [workout, setWorkout] = useState<WorkoutDTO | null>(null);
    useEffect(() => {
        const fetchWorkout = async () => {
            const workout = await WorkoutApiGateway.getOneWorkout(workoutId);
            setWorkout(workout);
        }

        fetchWorkout();
    }, [workoutId]);

    return workout;
}

export default useGetOneWorkoutById;