import React from "react";
import MuscleApiGateway from "app/common/services/api/gateway/MuscleApiGateway.tsx";
import DeleteButton from "app/common/components/button/DeleteButton.tsx";
import {useNavigate} from "react-router-dom";

type MuscleDeleteButtonType = {
    muscleId: number,
    postDeleteTarget: string,
}

const AdminMuscleDeleteButton: React.FC<MuscleDeleteButtonType> = ({ muscleId, postDeleteTarget }) => {
     const navigate = useNavigate();

     const handleDeleteMuscle = async () => {
        try {
            await MuscleApiGateway.deleteMuscle(muscleId);
            navigate(postDeleteTarget);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <DeleteButton targetId={muscleId} onConfirmDeleteFunction={handleDeleteMuscle} />
    )
}

export default AdminMuscleDeleteButton;