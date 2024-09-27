import React from "react";
import DeleteButton from "../common/button/DeleteButton.tsx";
import WorkoutApiGateway from "../../api/gateway/WorkoutApiGateway.tsx";

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