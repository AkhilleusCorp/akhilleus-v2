import React from 'react';
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import {useNavigate} from "react-router-dom";
import MuscleDTO from "app/services/api/dtos/MuscleDTO.tsx";
import websiteRoutes from "app/services/router/websiteRoutes.tsx";
import muscleRegistries from "app/constants/muscleRegistries.tsx";
import DetailsButton from "app/components/button/DetailsButton.tsx";
import MuscleDeleteButton from "app/features/muscle/MuscleDeleteButton.tsx";
import EditButton from "app/components/button/EditButton.tsx";

type MuscleDetailsCardType = {
    muscle: MuscleDTO,
    displayReadActions: boolean,
    displayWriteActions: boolean
}

const MusclePreviewCard: React.FC<MuscleDetailsCardType> = ({ muscle, displayReadActions, displayWriteActions }) => {
    const navigate = useNavigate();

    const onConfirmDelete = () => {
        navigate(websiteRoutes.muscle.list);
    }

    return (
        <Card className={'margin-bottom-s'}>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    {muscle.name} #{muscle.id}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    Status: {muscleRegistries.status[muscle.status]}
                </Typography>
            </CardContent>

            <CardActions>
                {displayReadActions && (
                    <DetailsButton routeToDetailsPage={websiteRoutes.muscle.details(muscle.id)}/>
                )}

                {displayWriteActions  && (
                    <>
                        <EditButton routeToEditPage={websiteRoutes.muscle.edit(muscle.id)} />
                        <MuscleDeleteButton muscleId={muscle.id} callbackFunction={onConfirmDelete} />
                    </>
                )}
            </CardActions>
        </Card>
    );
}

export default MusclePreviewCard;