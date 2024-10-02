import React from "react";
import {useNavigate} from "react-router-dom";
import {Button} from "@mui/material";

type DetailsButtonType = {
    routeToDetailsPage: string
}

const DetailsButton: React.FC<DetailsButtonType> = ({ routeToDetailsPage }) => {
    const navigate = useNavigate();
    const handleClick = () => {
        navigate(routeToDetailsPage);
    }

    return (
        <Button variant="contained" onClick={handleClick}>Details</Button>
    )
}

export default DetailsButton;