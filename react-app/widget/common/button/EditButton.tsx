import React from "react";
import {useNavigate} from "react-router-dom";

type EditButtonType = {
    routeToEditPage: string
}

const EditButton: React.FC<EditButtonType> = ({ routeToEditPage }) => {
    const navigate = useNavigate();
    const handleClick = () => {
        navigate(routeToEditPage);
    }

    return (
        <button className={"btn-warning"} onClick={handleClick}>Edit</button>
    )
}

export default EditButton;