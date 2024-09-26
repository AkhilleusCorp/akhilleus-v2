import WorkoutDTO from "../../dtos/WorkoutDTO.tsx";
import {useEffect, useState} from "react";
import WorkoutsListFilters from "../../filters/WorkoutsListFilters.tsx";
import WorkoutAPI from "../../api/WorkoutApi.tsx";


function useGetManyWorkoutsByParams(filters: WorkoutsListFilters, refreshKey: number): WorkoutDTO[] {
    const [workouts, setWorkouts] = useState<WorkoutDTO[]>([]);
    useEffect(() => {
        const fetchWorkouts = async () => {
            const workouts= await WorkoutAPI.getManyWorkouts(filters);
            setWorkouts(workouts);
        }

        fetchWorkouts();
    }, [refreshKey]);

    return workouts;
}

export default useGetManyWorkoutsByParams;