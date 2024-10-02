import React, {useState} from "react";
import ConfirmActionModal from "../modal/ConfirmActionModal.tsx";
import {Button} from "@mui/material";

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
        }
    }

    return (
        <>
            <ConfirmActionModal targetId={confirmedTargetId} onCancel={onCancelDelete} onConfirm={handleDeleteUser}/>
            <Button variant="contained" color="error" onClick={onClickDelete}>Delete</Button>
        </>
    )
}

export default DeleteButton;