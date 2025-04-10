import {useEffect, useState} from "react";
import WorkoutApiGateway from "app/common/services/api/gateway/WorkoutApiGateway.tsx";
import WorkoutDTO from "app/common/services/api/dtos/WorkoutDTO.tsx";
import QueryId from "app/common/utils/types/QueryId.tsx";

function useStartOneWorkoutById(workoutId: QueryId): WorkoutDTO | null {
    if (!workoutId) {
        return null;
    }

    const [workout, setWorkout] = useState<WorkoutDTO | null>(null);
    useEffect(() => {
        const fetchWorkout = async () => {
            const workout = await WorkoutApiGateway.startWorkout(workoutId);
            setWorkout(workout);
        }

        fetchWorkout();
    }, [workoutId]);

    return workout;
}

export default useStartOneWorkoutById;