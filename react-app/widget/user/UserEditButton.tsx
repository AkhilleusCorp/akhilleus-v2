import React from "react";
import {useNavigate} from "react-router-dom";

type UserEditButtonType = {
    userId: number,
}

const UserEditButton: React.FC<UserEditButtonType> = ({ userId }) => {
    const navigate = useNavigate();
    const handleClick = () => {
        navigate('/users/'+userId+'/edit');
    }

    return (
        <button className={"btn-warning"} onClick={handleClick}>Edit</button>
    )
}

export default UserEditButton;