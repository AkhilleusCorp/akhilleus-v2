import React from "react";
import UserApiGateway from "app/services/api/gateway/UserApiGateway.tsx";
import DeleteButton from "app/components/button/DeleteButton.tsx";

type UserDeleteButtonType = {
    userId: number,
    callbackFunction: (userId: number) => void;
}

const UserDeleteButton: React.FC<UserDeleteButtonType> = ({ userId, callbackFunction }) => {
    const handleDeleteUser = async () => {
        try {
            await UserApiGateway.deleteUser(userId);
            callbackFunction(userId);
        } catch (error) {
            console.log(error);
        }
    }

    return (
       <DeleteButton targetId={userId} onConfirmDeleteFunction={handleDeleteUser} />
    )
}

export default UserDeleteButton;