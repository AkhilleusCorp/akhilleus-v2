import React, {useState} from 'react';
import {
    Button,
    Dialog,
    DialogActions,
    DialogContent,
    DialogTitle, SelectChangeEvent
} from "@mui/material";
import IndexedArray from "app/common/utils/interfaces/IndexedArray.tsx";
import SelectInput from "app/common/components/input/SelectInput.tsx";
import DurationSelectInput from "app/common/components/input/DurationSelectInput.tsx";
import ExerciseGroupSource from "app/common/services/api/sources/ExerciseGroupSource.tsx";

type ExerciseGroupAddModalType = {
    shouldBeOpen: boolean;
    movements: IndexedArray;
    type: 'exercise' | 'superset' | 'circuit',
    onCancel: () => void;
    onConfirm: (exerciseGroupCreate: ExerciseGroupSource) => void;
}

const ExerciseGroupAddModal: React.FC<ExerciseGroupAddModalType> = (
    { shouldBeOpen, movements, type, onCancel, onConfirm }) => {
    const [exerciseGroupCreate, setExerciseGroupCreate] = useState<ExerciseGroupSource>({movementIds: [], restDuration: null});
    const [movementIds, setMovementIds] = useState<number[]>([]);

    const onConfirmClick = () => {
        exerciseGroupCreate.movementIds = movementIds;
        onConfirm(exerciseGroupCreate);
    }

    const handleSelectChange = (event: SelectChangeEvent) => {
        setExerciseGroupCreate({
            ...exerciseGroupCreate,
            [event.target.name]: parseInt(event.target.value)
        })
    }

    const handleMovementChange = (event: SelectChangeEvent) => {
        setMovementIds((prevMovementIds) => [
            ...prevMovementIds,
            parseInt(event.target.value)
        ]);
    }

    return (
        <Dialog
            open={shouldBeOpen}>
            <DialogTitle>
                Add exercise
            </DialogTitle>
            <DialogContent>
                <SelectInput label={"Exercise"} name={"movementId"} value={null}
                             options={movements} required={true} onSelectChange={handleMovementChange}/>
                { type === 'superset' && (
                    <SelectInput label={"Exercise"} name={"movementId2"} value={null}
                                 options={movements} required={true} onSelectChange={handleMovementChange}/>
                )}
                <DurationSelectInput label={"Rest"} name={"restDuration"} value={null}
                             required={false} onSelectChange={handleSelectChange}/>
            </DialogContent>

            <DialogActions>
                <Button onClick={onCancel} variant="outlined">Cancel</Button>
                <Button onClick={onConfirmClick} variant="contained">Add</Button>
            </DialogActions>
        </Dialog>
    );
}

export default ExerciseGroupAddModal;