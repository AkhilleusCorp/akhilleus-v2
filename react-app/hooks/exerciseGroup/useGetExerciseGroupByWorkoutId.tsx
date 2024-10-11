import {useEffect, useState} from "react";
import ExerciseGroupApiGateway from "../../services/api/gateway/ExerciseGroupApiGateway.tsx";
import ExerciseGroupDTO from "../../services/api/dtos/ExerciseGroupDTO.tsx";
import QueryId from "../../utils/interfaces/QueryId.tsx";

function useGetExerciseGroupByWorkoutId(workoutId: QueryId|null): ExerciseGroupDTO[] {
    if (null == workoutId) {
        return [];
    }

    const [groups, setGroups] = useState<ExerciseGroupDTO[]>([]);
    useEffect(() => {
        const fetchGroups = async () => {
            const groups = await ExerciseGroupApiGateway.getManyExerciseGroups(workoutId);
            setGroups(groups);
        }

        fetchGroups();
    }, []);

    return groups;
}

export default useGetExerciseGroupByWorkoutId;