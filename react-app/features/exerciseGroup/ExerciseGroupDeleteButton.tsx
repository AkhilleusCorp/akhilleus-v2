import React from "react";
import ExerciseGroupApiGateway from "app/services/api/gateway/ExerciseGroupApiGateway.tsx";
import DeleteButton from "app/components/button/DeleteButton.tsx";

type ExerciseGroupDeleteButtonType = {
    workoutId: number,
    exerciseGroupId: number,
    callbackFunction: (exerciseGroupId: number) => void;
}

const ExerciseGroupDeleteButton: React.FC<ExerciseGroupDeleteButtonType> = ({ workoutId, exerciseGroupId, callbackFunction }) => {
    const handleDeleteExerciseGroup = async () => {
        try {
            await ExerciseGroupApiGateway.deleteExerciseGroup(workoutId, exerciseGroupId);
            callbackFunction(exerciseGroupId);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <DeleteButton targetId={exerciseGroupId} onConfirmDeleteFunction={handleDeleteExerciseGroup} />
    )
}

export default ExerciseGroupDeleteButton;