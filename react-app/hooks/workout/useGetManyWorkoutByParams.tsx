import {useEffect, useState} from "react";
import WorkoutsListFilters from "../../services/api/filters/WorkoutsListFilters.tsx";
import WorkoutApiGateway from "../../services/api/gateway/WorkoutApiGateway.tsx";
import WorkoutDTO from "../../services/api/dtos/WorkoutDTO.tsx";



function useGetManyWorkoutsByParams(filters: WorkoutsListFilters, refreshKey: number): WorkoutDTO[] {
    const [workouts, setWorkouts] = useState<WorkoutDTO[]>([]);
    useEffect(() => {
        const fetchWorkouts = async () => {
            const workouts= await WorkoutApiGateway.getManyWorkouts(filters);
            setWorkouts(workouts);
        }

        fetchWorkouts();
    }, [refreshKey]);

    return workouts;
}

export default useGetManyWorkoutsByParams;