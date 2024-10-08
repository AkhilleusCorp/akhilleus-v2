import React, {useState} from "react";
import {Button} from "@mui/material";
import IndexedArray from "../../utils/interfaces/IndexedArray.tsx";
import ExerciseGroupAddModal from "./ExerciseGroupAddModal.tsx";
import ExerciseGroupApiGateway from "../../services/api/gateway/ExerciseGroupApiGateway.tsx";
import ExerciseGroupDTO from "../../services/api/dtos/ExerciseGroupDTO.tsx";

type ExerciseGroupAddButtonType = {
    workoutId: number,
    type: 'exercise' | 'superset' | 'circuit',
    movements: IndexedArray,
    callbackFunction: (group: ExerciseGroupDTO) => void
}

const ExerciseGroupAddButton: React.FC<ExerciseGroupAddButtonType> = ({ workoutId, type, movements, callbackFunction }) => {
    const [openModal, setOpenModal] = useState<boolean>(false);

    const onClickAdd = () => {
        setOpenModal(true);
    }

    const onCancelAdd = () => {
        setOpenModal(false);
    }

    const handleAddExerciseGroup = async (movementIds: number[]) => {
        try {
            const exerciseGroup = await ExerciseGroupApiGateway.createOneExerciseGroup(workoutId, {movementIds: movementIds});
            setOpenModal(false);

            callbackFunction(exerciseGroup);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <>
            <ExerciseGroupAddModal movements={movements} shouldBeOpen={openModal} type={type}
                                   onCancel={onCancelAdd} onConfirm={handleAddExerciseGroup}/>
            <Button type={"button"} variant="contained" onClick={onClickAdd}>{'Add '+ type}</Button>
        </>
    )
}

export default ExerciseGroupAddButton;