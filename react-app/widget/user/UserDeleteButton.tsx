import React from "react";
import UserApi from "../../api/UserApi.tsx";

type UserDeleteButtonType = {
    userId: number,
    callbackFunction: (userId: number) => void;
}

const UserDeleteButton: React.FC<UserDeleteButtonType> = ({ userId, callbackFunction }) => {
    const handleDeleteUser = async () => {
        try {
            await UserApi.deleteUser(userId);
            callbackFunction(userId);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <button className={"btn-danger"} onClick={handleDeleteUser}>Delete</button>
    )
}

export default UserDeleteButton;