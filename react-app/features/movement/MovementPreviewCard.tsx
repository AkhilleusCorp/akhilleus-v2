import React from 'react';
import EditButton from "../../components/button/EditButton.tsx";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import DetailsButton from "../../components/button/DetailsButton.tsx";
import MovementDTO from "../../services/api/dtos/MovementDTO.tsx";
import {Card, CardActions, CardContent, Chip, Typography} from "@mui/material";
import MovementDeleteButton from "./MovementDeleteButton.tsx";
import {useNavigate} from "react-router-dom";
import movementRegistries from "../../constants/movementRegistries.tsx";

type MovementDetailsCardType = {
    movement: MovementDTO,
    displayReadActions: boolean,
    displayWriteActions: boolean
}

const MovementPreviewCard: React.FC<MovementDetailsCardType> = ({ movement, displayReadActions, displayWriteActions }) => {
    const navigate = useNavigate();

    const onConfirmDelete = () => {
        navigate(websiteRoutes.movement.list);
    }

    return (
        <Card className={'margin-bottom-s'}>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    {movement.name} #{movement.id}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    Status: {movementRegistries.status[movement.status]}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    Primary muscle: <Chip label={movement.primaryMuscle.label} color="primary"/>
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    Auxiliary muscles:
                    { movement.auxiliaryMuscles.map((muscle) => (
                        <Chip variant="outlined" label={muscle.label} color="primary"/>
                    ))}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    Equipments:
                    { movement.equipments.map((equipment) => (
                        <Chip variant="outlined" label={equipment.label} color="primary"/>
                    ))}
                </Typography>
            </CardContent>

            <CardActions>
                {displayReadActions && (
                    <DetailsButton routeToDetailsPage={websiteRoutes.movement.details(movement.id)}/>
                )}

                {displayWriteActions  && (
                    <>
                        <EditButton routeToEditPage={websiteRoutes.movement.edit(movement.id)} />
                        <MovementDeleteButton movementId={movement.id} callbackFunction={onConfirmDelete} />
                    </>
                )}
            </CardActions>
        </Card>
    );
}

export default MovementPreviewCard;