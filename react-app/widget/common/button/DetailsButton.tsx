import React from "react";
import {useNavigate} from "react-router-dom";

type DetailsButtonType = {
    routeToDetailsPage: string
}

const DetailsButton: React.FC<DetailsButtonType> = ({ routeToDetailsPage }) => {
    const navigate = useNavigate();
    const handleClick = () => {
        navigate(routeToDetailsPage);
    }

    return (
        <button onClick={handleClick}>Details</button>
    )
}

export default DetailsButton;