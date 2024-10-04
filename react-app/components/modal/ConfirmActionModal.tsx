import React from 'react';
import {
    Button,
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle
} from "@mui/material";

type ConfirmActionModalType = {
    targetId: number|null;
    onCancel: () => void;
    onConfirm: (targetId: number) => void;
}

const ConfirmActionModal: React.FC<ConfirmActionModalType> = ({ targetId, onCancel, onConfirm }) => {
    if (null == targetId) {
        return null;
    }

    const onConfirmClick = () => {
        onConfirm(targetId);
    }

    return (
        <Dialog
            open={true}>
            <DialogTitle>
                Confirmation
            </DialogTitle>
            <DialogContent>
                <DialogContentText>
                    Are you sure you want to process with delete ? <br />
                    <strong>This operation is irreversible !</strong>
                </DialogContentText>
            </DialogContent>

            <DialogActions>
                <Button onClick={onCancel} variant="outlined">Cancel</Button>
                <Button onClick={onConfirmClick} variant="contained" color="error">Confirm</Button>
            </DialogActions>
        </Dialog>
    );
}

export default ConfirmActionModal;