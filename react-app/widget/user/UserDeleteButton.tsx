import React, {useState} from "react";
import UserApi from "../../api/UserApi.tsx";
import ConfirmActionModal from "../common/modal/ConfirmActionModal.tsx";

type UserDeleteButtonType = {
    userId: number,
    callbackFunction: (userId: number) => void;
}

const UserDeleteButton: React.FC<UserDeleteButtonType> = ({ userId, callbackFunction }) => {
    const [targetId, setTargetId] = useState<number|null>(null)

    const onClickDelete = () => {
        setTargetId(userId);
    }

    const onCancelDelete = () => {
        setTargetId(null);
    }

    const handleDeleteUser = async () => {
        try {
            await UserApi.deleteUser(userId);
            callbackFunction(userId);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <>
            <ConfirmActionModal targetId={targetId} onCancel={onCancelDelete} onConfirm={handleDeleteUser}/>
            <button className={"btn-danger"} onClick={onClickDelete}>Delete</button>
        </>
    )
}

export default UserDeleteButton;