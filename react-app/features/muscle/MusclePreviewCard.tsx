import React from 'react';
import EditButton from "../../components/button/EditButton.tsx";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import DetailsButton from "../../components/button/DetailsButton.tsx";
import MuscleDTO from "../../services/api/dtos/MuscleDTO.tsx";
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import MuscleDeleteButton from "./MuscleDeleteButton.tsx";
import {useNavigate} from "react-router-dom";

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
                    {muscle.name}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    ID: {muscle.id}
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