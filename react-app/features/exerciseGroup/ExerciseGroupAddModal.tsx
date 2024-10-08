import React, {useState} from 'react';
import {
    Button,
    Dialog,
    DialogActions,
    DialogContent,
    DialogTitle, SelectChangeEvent
} from "@mui/material";
import SelectInput from "../../components/input/SelectInput.tsx";
import IndexedArray from "../../utils/interfaces/IndexedArray.tsx";

type ExerciseGroupAddModalType = {
    shouldBeOpen: boolean;
    movements: IndexedArray;
    type: 'exercise' | 'superset' | 'circuit',
    onCancel: () => void;
    onConfirm: (movementIds: number[]) => void;
}

const ExerciseGroupAddModal: React.FC<ExerciseGroupAddModalType> = (
    { shouldBeOpen, movements, type, onCancel, onConfirm }) => {
    const [indexedMovementIds, setIndexedMovementIds] = useState<IndexedArray>({});

    const onConfirmClick = () => {
        const movementIds = [];
        for (const movementId in indexedMovementIds) {
            movementIds.push(indexedMovementIds[movementId] as number);
        }

        onConfirm(movementIds)
    }

    const handleSelectChange = (event: SelectChangeEvent) => {
        setIndexedMovementIds({
            ...indexedMovementIds,
            [event.target.name]: event.target.value
        })
    }

    return (
        <Dialog
            open={shouldBeOpen}>
            <DialogTitle>
                Add exercise
            </DialogTitle>
            <DialogContent>
                <SelectInput label={"Exercise"} name={"movementId"} value={null}
                             options={movements} required={true} onSelectChange={handleSelectChange}/>
                { type === 'superset' && (
                    <SelectInput label={"Exercise"} name={"movementId2"} value={null}
                                 options={movements} required={true} onSelectChange={handleSelectChange}/>
                )}
            </DialogContent>

            <DialogActions>
                <Button onClick={onCancel} variant="outlined">Cancel</Button>
                <Button onClick={onConfirmClick} variant="contained">Add</Button>
            </DialogActions>
        </Dialog>
    );
}

export default ExerciseGroupAddModal;