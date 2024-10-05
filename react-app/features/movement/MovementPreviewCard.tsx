import React from 'react';
import EditButton from "../../components/button/EditButton.tsx";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import DetailsButton from "../../components/button/DetailsButton.tsx";
import MovementDTO from "../../services/api/dtos/MovementDTO.tsx";
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import MovementDeleteButton from "./MovementDeleteButton.tsx";
import {useNavigate} from "react-router-dom";

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
                    {movement.name}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    ID: {movement.id}
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