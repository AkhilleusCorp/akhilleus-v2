import {useEffect, useState} from "react";
import MusclesListFilters from "../../services/api/filters/MusclesListFilters.tsx";
import MuscleApiGateway from "../../services/api/gateway/MuscleApiGateway.tsx";
import MuscleDTO from "../../services/api/dtos/MuscleDTO.tsx";

function useGetManyMusclesByParams(filters: MusclesListFilters, refreshKey: number): MuscleDTO[] {
    const [muscles, setMuscles] = useState<MuscleDTO[]>([]);
    useEffect(() => {
        const fetchMuscles = async () => {
            const muscles= await MuscleApiGateway.getManyMuscles(filters);
            setMuscles(muscles);
        }

        fetchMuscles();
    }, [refreshKey]);

    return muscles;
}

export default useGetManyMusclesByParams;