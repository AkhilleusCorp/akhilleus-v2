import React from "react";
import DeleteButton from "../../components/button/DeleteButton.tsx";
import ExerciseGroupApiGateway from "../../services/api/gateway/ExerciseGroupGateway.tsx";

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