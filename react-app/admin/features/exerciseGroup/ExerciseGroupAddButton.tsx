import React, {useState} from "react";
import {Button} from "@mui/material";
import { useDispatch } from "react-redux";
import IndexedArray from "app/common/utils/interfaces/IndexedArray.tsx";
import {AdminDispatch} from "app/admin/services/redux";
import {addExerciseGroup} from "app/common/services/redux/reducers/ExerciseGroupSlice.tsx";
import ExerciseGroupAddModal from "app/admin/features/exerciseGroup/ExerciseGroupAddModal.tsx";

type ExerciseGroupAddButtonType = {
    workoutId: number,
    type: 'exercise' | 'superset' | 'circuit',
    movements: IndexedArray
}

const ExerciseGroupAddButton: React.FC<ExerciseGroupAddButtonType> = ({ workoutId, type, movements }) => {
    const [openModal, setOpenModal] = useState<boolean>(false);
    const dispatch = useDispatch<AdminDispatch>();

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