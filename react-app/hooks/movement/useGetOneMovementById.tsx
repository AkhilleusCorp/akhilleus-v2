import {useEffect, useState} from "react";
import MovementApiGateway from "../../services/api/gateway/MovementApiGateway.tsx";
import MovementDTO from "../../services/api/dtos/MovementDTO.tsx";

function useGetOneMovementById(movementId: string|undefined): MovementDTO | null {
    if (!movementId) {
        return null;
    }

    const [movement, setMovement] = useState<MovementDTO | null>(null);
    useEffect(() => {
        const fetchMovement = async () => {
            const movement = await MovementApiGateway.getOneMovement(movementId);
            setMovement(movement);
        }

        fetchMovement();
    }, [movementId]);

    return movement;
}

export default useGetOneMovementById;