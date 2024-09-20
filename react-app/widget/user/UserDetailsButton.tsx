import React from "react";
import {useNavigate} from "react-router-dom";
import routes from "../../infrastructure/router/routes-mapping.tsx";

type UserEditButtonType = {
    userId: number,
}

const UserDetailsButton: React.FC<UserEditButtonType> = ({ userId }) => {
    const navigate = useNavigate();
    const handleClick = () => {
        navigate(routes.userDetails(userId));
    }

    return (
        <button onClick={handleClick}>Details</button>
    )
}

export default UserDetailsButton;