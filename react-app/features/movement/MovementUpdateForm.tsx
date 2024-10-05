import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import MovementApiGateway from "../../services/api/gateway/MovementApiGateway.tsx";
import MovementDTO from "../../services/api/dtos/MovementDTO.tsx";
import {TextField} from "@mui/material";

type MovementUpdateFormType = {
    movement: MovementDTO,
}

const MovementUpdateForm: React.FC<MovementUpdateFormType> = ({movement}) => {
    const navigate = useNavigate();
    const [movementUpdated, setMovementUpdated] = useState<MovementDTO>(movement);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMovementUpdated({
            ...movementUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            await MovementApiGateway.updateMovement(movement.id, movementUpdated);
            navigate(websiteRoutes.movement.details(movement.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <TextField id="outlined-basic" label="Name" variant="outlined" size="small" required={true}
                           name={"name"} value={movementUpdated.name} onChange={handleInputChange} />
            </div>
        </SaveForm>
    )
}

export default MovementUpdateForm;