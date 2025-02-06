import React from "react";
import MovementApiGateway from "app/common/services/api/gateway/MovementApiGateway.tsx";
import DeleteButton from "app/common/components/button/DeleteButton.tsx";

type MovementDeleteButtonType = {
    movementId: number,
    callbackFunction: (movementId: number) => void;
}

const AdminMovementDeleteButton: React.FC<MovementDeleteButtonType> = ({ movementId, callbackFunction }) => {
    const handleDeleteMovement = async () => {
        try {
            await MovementApiGateway.deleteMovement(movementId);
            callbackFunction(movementId);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <DeleteButton targetId={movementId} onConfirmDeleteFunction={handleDeleteMovement} />
    )
}

export default AdminMovementDeleteButton;