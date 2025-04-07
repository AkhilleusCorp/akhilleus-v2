import React from "react";
import MovementApiGateway from "app/common/services/api/gateway/MovementApiGateway.tsx";
import DeleteButton from "app/common/components/button/DeleteButton.tsx";
import {useNavigate} from "react-router-dom";

type MovementDeleteButtonType = {
    movementId: number,
    postDeleteTarget: string;
}

const AdminMovementDeleteButton: React.FC<MovementDeleteButtonType> = ({ movementId, postDeleteTarget }) => {
    const navigate = useNavigate();

    const handleDeleteMovement = async () => {
        try {
            await MovementApiGateway.deleteMovement(movementId);
            navigate(postDeleteTarget);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <DeleteButton targetId={movementId} onConfirmDeleteFunction={handleDeleteMovement} />
    )
}

export default AdminMovementDeleteButton;