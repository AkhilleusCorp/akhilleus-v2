import React from 'react';
import {Box, Button, Modal} from "@mui/material";

const style = {
    position: 'absolute' as 'absolute',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    width: 400,
    bgcolor: 'background.paper',
    border: '2px solid #000',
    boxShadow: 24,
    pt: 2,
    px: 4,
    pb: 3,
};

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
        <Modal
            open={true}>
            <Box sx={{ ...style, width: 400}}>
                <h3>Confirmation</h3>
                <p>
                    Are you sure you want to delete user #{targetId} ? <br />
                    <strong>This operation is irreversible !</strong>
                </p>
                <div>
                    <Button onClick={onCancel} variant="outlined">Cancel</Button>
                    <Button onClick={onConfirmClick} variant="contained" color="error">Confirm</Button>
                </div>
            </Box>
        </Modal>
    );
}

export default ConfirmActionModal;