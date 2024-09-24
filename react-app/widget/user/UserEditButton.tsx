import React from "react";
import {useNavigate} from "react-router-dom";
import routes from "../../infrastructure/router/routes-mapping.tsx";

type UserEditButtonType = {
    userId: number,
}

const UserEditButton: React.FC<UserEditButtonType> = ({ userId }) => {
    const navigate = useNavigate();
    const handleClick = () => {
        navigate(routes.user.edit(userId));
    }

    return (
        <button className={"btn-warning"} onClick={handleClick}>Edit</button>
    )
}

export default UserEditButton;