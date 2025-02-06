import {useEffect, useState} from "react";
import ExerciseGroupApiGateway from "app/common/services/api/gateway/ExerciseGroupApiGateway.tsx";
import ExerciseGroupDTO from "app/common/services/api/dtos/ExerciseGroupDTO.tsx";
import QueryId from "app/common/utils/types/QueryId.tsx";

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