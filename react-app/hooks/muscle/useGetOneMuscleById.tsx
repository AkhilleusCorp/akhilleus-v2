import {useEffect, useState} from "react";
import MuscleApiGateway from "app/services/api/gateway/MuscleApiGateway.tsx";
import MuscleDTO from "app/services/api/dtos/MuscleDTO.tsx";

function useGetOneMuscleById(muscleId: string|undefined): MuscleDTO | null {
    if (!muscleId) {
        return null;
    }

    const [muscle, setMuscle] = useState<MuscleDTO | null>(null);
    useEffect(() => {
        const fetchMuscle = async () => {
            const muscle = await MuscleApiGateway.getOneMuscle(muscleId);
            setMuscle(muscle);
        }

        fetchMuscle();
    }, [muscleId]);

    return muscle;
}

export default useGetOneMuscleById;