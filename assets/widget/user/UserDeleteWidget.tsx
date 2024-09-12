import React from "react";
import deleteUser from "../../hooks/user/useDeleteOneUserById.tsx";

type UserCardWidgetProps = {
    userId: number,
    callbackFunction: (userId: number) => void;
}

const UserDeleteWidget: React.FC<UserCardWidgetProps> = ({ userId, callbackFunction }) => {
    const handleDeleteUser = async () => {
        try {
            await deleteUser(userId);
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