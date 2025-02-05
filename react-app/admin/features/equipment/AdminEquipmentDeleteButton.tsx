import React from "react";
import EquipmentApiGateway from "app/common/services/api/gateway/EquipmentApiGateway.tsx";
import DeleteButton from "app/common/components/button/DeleteButton.tsx";

type EquipmentDeleteButtonType = {
    equipmentId: number,
    callbackFunction: (equipmentId: number) => void;
}

const AdminEquipmentDeleteButton: React.FC<EquipmentDeleteButtonType> = ({ equipmentId, callbackFunction }) => {
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

export default AdminEquipmentDeleteButton;