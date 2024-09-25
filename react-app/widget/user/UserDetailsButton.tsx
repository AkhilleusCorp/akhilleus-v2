import React from "react";
import {useNavigate} from "react-router-dom";
import routes from "../../infrastructure/router/routes-mapping.tsx";

type UserDetailsButtonType = {
    userId: number,
}

const UserDetailsButton: React.FC<UserDetailsButtonType> = ({ userId }) => {
    const navigate = useNavigate();
    const handleClick = () => {
        navigate(routes.user.details(userId));
    }

    return (
        <button onClick={handleClick}>Details</button>
    )
}

export default UserDetailsButton;