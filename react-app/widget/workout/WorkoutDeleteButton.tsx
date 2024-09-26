import React from "react";
import WorkoutApi from "../../api/WorkoutApi.tsx";
import DeleteButton from "../common/button/DeleteButton.tsx";

type WorkoutDeleteButtonType = {
    workoutId: number,
    callbackFunction: (workoutId: number) => void;
}

const WorkoutDeleteButton: React.FC<WorkoutDeleteButtonType> = ({ workoutId, callbackFunction }) => {
    const handleDeleteWorkout = async () => {
        try {
            await WorkoutApi.deleteWorkout(workoutId);
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