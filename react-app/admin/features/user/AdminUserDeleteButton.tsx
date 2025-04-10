import React from "react";
import UserApiGateway from "app/common/services/api/gateway/UserApiGateway.tsx";
import DeleteButton from "app/common/components/button/DeleteButton.tsx";
import {useNavigate} from "react-router-dom";

type UserDeleteButtonType = {
    userId: number,
    postDeleteTarget: string;
}

const AdminUserDeleteButton: React.FC<UserDeleteButtonType> = ({ userId, postDeleteTarget }) => {
    const navigate = useNavigate();

    const handleDeleteUser = async () => {
        try {
            await UserApiGateway.deleteUser(userId);
            navigate(postDeleteTarget);
        } catch (error) {
            console.log(error);
        }
    }

    return (
       <DeleteButton targetId={userId} onConfirmDeleteFunction={handleDeleteUser} />
    )
}

export default AdminUserDeleteButton;