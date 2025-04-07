import React from "react";
import WorkoutApiGateway from "app/common/services/api/gateway/WorkoutApiGateway.tsx";
import DeleteButton from "app/common/components/button/DeleteButton.tsx";
import {useNavigate} from "react-router-dom";

type WorkoutDeleteButtonType = {
    workoutId: number,
    postDeleteTarget: string;
}

const WorkoutDeleteButton: React.FC<WorkoutDeleteButtonType> = ({ workoutId, postDeleteTarget }) => {
    const navigate = useNavigate();

    const handleDeleteWorkout = async () => {
        try {
            await WorkoutApiGateway.deleteWorkout(workoutId);
            navigate(postDeleteTarget);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <DeleteButton targetId={workoutId} onConfirmDeleteFunction={handleDeleteWorkout} />
    )
}

export default WorkoutDeleteButton;