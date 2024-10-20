import {useEffect, useState} from "react";
import MovementApiGateway from "app/services/api/gateway/MovementApiGateway.tsx";
import IndexedArray from "app/utils/interfaces/IndexedArray.tsx";

function useGetDropdownableMovements(): IndexedArray {
    const [movements, setMovements] = useState<IndexedArray>({});
    useEffect(() => {
        const fetchMovements = async () => {
            const movements= await MovementApiGateway.getDropdownableMovements();
            setMovements(movements);
        }

        fetchMovements();
    }, []);

    return movements;
}

export default useGetDropdownableMovements;