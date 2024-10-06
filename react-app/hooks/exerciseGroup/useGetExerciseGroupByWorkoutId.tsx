import {useEffect, useState} from "react";
import ExerciseGroupApiGateway from "../../services/api/gateway/ExerciseGroupGateway.tsx";
import ExerciseGroupDTO from "../../services/api/dtos/ExerciseGroupDTO.tsx";

function useGetExerciseGroupByWorkoutId(workoutId: string|undefined): ExerciseGroupDTO[] {
    if (!workoutId) {
        return [];
    }

    const [groups, setGroups] = useState<ExerciseGroupDTO[]>([]);
    useEffect(() => {
        const fetchGroups = async () => {
            const groups = await ExerciseGroupApiGateway.getManyExerciseGroups(workoutId);
            setGroups(groups);
        }

        fetchGroups();
    }, [workoutId]);

    return groups;
}

export default useGetExerciseGroupByWorkoutId;