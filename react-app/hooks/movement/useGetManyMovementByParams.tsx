import {useEffect, useState} from "react";
import MovementsListFilters from "../../services/api/filters/MovementsListFilters.tsx";
import MovementApiGateway from "../../services/api/gateway/MovementApiGateway.tsx";
import MovementDTO from "../../services/api/dtos/MovementDTO.tsx";

function useGetManyMovementsByParams(filters: MovementsListFilters, refreshKey: number): MovementDTO[] {
    const [movements, setMovements] = useState<MovementDTO[]>([]);
    useEffect(() => {
        const fetchMovements = async () => {
            const movements= await MovementApiGateway.getManyMovements(filters);
            setMovements(movements);
        }

        fetchMovements();
    }, [refreshKey]);

    return movements;
}

export default useGetManyMovementsByParams;