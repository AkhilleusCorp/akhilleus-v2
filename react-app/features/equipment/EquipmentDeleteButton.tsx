import React from "react";
import EquipmentApiGateway from "../../services/api/gateway/EquipmentApiGateway.tsx";
import DeleteButton from "../../components/button/DeleteButton.tsx";

type EquipmentDeleteButtonType = {
    equipmentId: number,
    callbackFunction: (equipmentId: number) => void;
}

const EquipmentDeleteButton: React.FC<EquipmentDeleteButtonType> = ({ equipmentId, callbackFunction }) => {
    const handleDeleteEquipment = async () => {
        try {
            await EquipmentApiGateway.deleteEquipment(equipmentId);
            callbackFunction(equipmentId);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <DeleteButton targetId={equipmentId} onConfirmDeleteFunction={handleDeleteEquipment} />
    )
}

export default EquipmentDeleteButton;