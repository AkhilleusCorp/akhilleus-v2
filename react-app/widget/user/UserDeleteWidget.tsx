import React from "react";
import UserApi from "../../api/UserApi.tsx";

type UserCardWidgetProps = {
    userId: number,
    callbackFunction: (userId: number) => void;
}

const UserDeleteWidget: React.FC<UserCardWidgetProps> = ({ userId, callbackFunction }) => {
    const handleDeleteUser = async () => {
        try {
            await UserApi.deleteUser(userId);
            callbackFunction(userId);
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <button onClick={handleDeleteUser}>Delete</button>
    )
}

export default UserDeleteWidget;