import React from 'react';
import {Card, CardActions, CardContent, Chip, Typography} from "@mui/material";
import {useNavigate} from "react-router-dom";
import MovementDTO from "app/admin/services/api/dtos/MovementDTO.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import movementRegistries from "app/common/constants/movementRegistries.tsx";
import DetailsButton from "app/common/components/button/DetailsButton.tsx";
import EditButton from "app/common/components/button/EditButton.tsx";
import MovementDeleteButton from "app/admin/features/movement/MovementDeleteButton.tsx";

type MovementDetailsCardType = {
    movement: MovementDTO,
    displayReadActions: boolean,
    displayWriteActions: boolean
}

const MovementPreviewCard: React.FC<MovementDetailsCardType> = ({ movement, displayReadActions, displayWriteActions }) => {
    const navigate = useNavigate();

    const onConfirmDelete = () => {
        navigate(adminRoutes.movement.list);
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
                    <DetailsButton routeToDetailsPage={adminRoutes.movement.details(movement.id)}/>
                )}

                {displayWriteActions  && (
                    <>
                        <EditButton routeToEditPage={adminRoutes.movement.edit(movement.id)} />
                        <MovementDeleteButton movementId={movement.id} callbackFunction={onConfirmDelete} />
                    </>
                )}
            </CardActions>
        </Card>
    );
}

export default MovementPreviewCard;