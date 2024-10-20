import React, {useState} from "react";
import {Button} from "@mui/material";
import ConfirmActionModal from "app/components/modal/ConfirmActionModal.tsx";

type DeleteButtonType = {
    targetId: number,
    onConfirmDeleteFunction: (targetId: number) => void;
}

const DeleteButton: React.FC<DeleteButtonType> = ({ targetId, onConfirmDeleteFunction }) => {
    const [confirmedTargetId, setConfirmedTargetId] = useState<number|null>(null)

    const onClickDelete = () => {
        setConfirmedTargetId(targetId);
    }

    const onCancelDelete = () => {
        setConfirmedTargetId(null);
    }

    const handleDeleteUser = () => {
        if (null !== confirmedTargetId) {
            onConfirmDeleteFunction(confirmedTargetId);
            setConfirmedTargetId(null);
        }
    }

    return (
        <>
            <ConfirmActionModal targetId={confirmedTargetId} onCancel={onCancelDelete} onConfirm={handleDeleteUser}/>
            <Button variant="outlined" color="error" onClick={onClickDelete}>Delete</Button>
        </>
    )
}

export default DeleteButton;