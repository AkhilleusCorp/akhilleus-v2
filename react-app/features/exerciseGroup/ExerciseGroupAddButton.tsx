import React, {useState} from "react";
import {Button} from "@mui/material";
import IndexedArray from "../../utils/interfaces/IndexedArray.tsx";
import ExerciseGroupAddModal from "./ExerciseGroupAddModal.tsx";
import { useDispatch } from "react-redux";
import { AppDispatch } from "../../services/redux/index.tsx";
import { addExerciseGroup } from "../../services/redux/reducers/ExerciseGroupSlice.tsx";

type ExerciseGroupAddButtonType = {
    workoutId: number,
    type: 'exercise' | 'superset' | 'circuit',
    movements: IndexedArray
}

const ExerciseGroupAddButton: React.FC<ExerciseGroupAddButtonType> = ({ workoutId, type, movements }) => {
    const [openModal, setOpenModal] = useState<boolean>(false);
    const dispatch = useDispatch<AppDispatch>();

    const onClickAdd = () => {
        setOpenModal(true);
    }

    const onCancelAdd = () => {
        setOpenModal(false);
    }

    const handleAddExerciseGroup = async (movementIds: number[]) => {
        dispatch(addExerciseGroup({workoutId, movementIds}));

        setOpenModal(false);
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