import React from "react";
import UserApi from "../../api/UserApi.tsx";
import Button from '@mui/material/Button';

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
        <Button variant="contained" onClick={handleDeleteUser}>Primary</Button>
    )
}

export default UserDeleteWidget;