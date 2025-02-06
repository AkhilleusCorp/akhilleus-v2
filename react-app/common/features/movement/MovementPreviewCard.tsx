import React from 'react';
import {Card, CardContent, Chip, Typography} from "@mui/material";
import MovementDTO from "app/common/services/api/dtos/MovementDTO.tsx";
import movementRegistries from "app/common/constants/movementRegistries.tsx";

type MovementDetailsCardType = {
    movement: MovementDTO
}

const MovementPreviewCard: React.FC<MovementDetailsCardType> = ({ movement }) => {
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
        </Card>
    );
}

export default MovementPreviewCard;