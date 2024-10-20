import {useEffect, useState} from "react";
import MuscleApiGateway from "app/services/api/gateway/MuscleApiGateway.tsx";
import IndexedArray from "app/utils/interfaces/IndexedArray.tsx";

function useGetDropdownableMuscles(): IndexedArray {
    const [muscles, setMuscles] = useState<IndexedArray>({});
    useEffect(() => {
        const fetchMuscles = async () => {
            const muscles= await MuscleApiGateway.getDropdownableMuscles();
            setMuscles(muscles);
        }

        fetchMuscles();
    }, []);

    return muscles;
}

export default useGetDropdownableMuscles;