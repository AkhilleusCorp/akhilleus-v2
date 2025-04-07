import React from "react";
import EquipmentApiGateway from "app/common/services/api/gateway/EquipmentApiGateway.tsx";
import DeleteButton from "app/common/components/button/DeleteButton.tsx";
import {useNavigate} from "react-router-dom";

type EquipmentDeleteButtonType = {
    equipmentId: number,
    postDeleteTarget: string;
}

const AdminEquipmentDeleteButton: React.FC<EquipmentDeleteButtonType> = ({ equipmentId, postDeleteTarget }) => {
    const navigate = useNavigate();

    const handleDeleteEquipment = async () => {
        try {
            await EquipmentApiGateway.deleteEquipment(equipmentId);
            navigate(postDeleteTarget);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <DeleteButton targetId={equipmentId} onConfirmDeleteFunction={handleDeleteEquipment} />
    )
}

export default AdminEquipmentDeleteButton;