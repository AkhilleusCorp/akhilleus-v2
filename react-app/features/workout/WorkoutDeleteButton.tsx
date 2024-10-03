import React from "react";
import WorkoutApiGateway from "../../services/api/gateway/WorkoutApiGateway.tsx";
import DeleteButton from "../../components/button/DeleteButton.tsx";

type WorkoutDeleteButtonType = {
    workoutId: number,
    callbackFunction: (workoutId: number) => void;
}

const WorkoutDeleteButton: React.FC<WorkoutDeleteButtonType> = ({ workoutId, callbackFunction }) => {
    const handleDeleteWorkout = async () => {
        try {
            await WorkoutApiGateway.deleteWorkout(workoutId);
            callbackFunction(workoutId);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <DeleteButton targetId={workoutId} onConfirmDeleteFunction={handleDeleteWorkout} />
    )
}

export default WorkoutDeleteButton;