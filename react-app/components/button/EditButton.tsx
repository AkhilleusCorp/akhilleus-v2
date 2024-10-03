import React from "react";
import {useNavigate} from "react-router-dom";
import {Button} from "@mui/material";

type EditButtonType = {
    routeToEditPage: string
}

const EditButton: React.FC<EditButtonType> = ({ routeToEditPage }) => {
    const navigate = useNavigate();
    const handleClick = () => {
        navigate(routeToEditPage);
    }

    return (
        <Button variant="outlined" onClick={handleClick}>Edit</Button>
    )
}

export default EditButton;