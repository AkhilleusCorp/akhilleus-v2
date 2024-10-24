import React from 'react';
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import {useNavigate} from "react-router-dom";
import MuscleDTO from "app/admin/services/api/dtos/MuscleDTO.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import muscleRegistries from "app/common/constants/muscleRegistries.tsx";
import DetailsButton from "app/common/components/button/DetailsButton.tsx";
import MuscleDeleteButton from "app/admin/features/muscle/MuscleDeleteButton.tsx";
import EditButton from "app/common/components/button/EditButton.tsx";

type MuscleDetailsCardType = {
    muscle: MuscleDTO,
    displayReadActions: boolean,
    displayWriteActions: boolean
}

const MusclePreviewCard: React.FC<MuscleDetailsCardType> = ({ muscle, displayReadActions, displayWriteActions }) => {
    const navigate = useNavigate();

    const onConfirmDelete = () => {
        navigate(adminRoutes.muscle.list);
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
                    <DetailsButton routeToDetailsPage={adminRoutes.muscle.details(muscle.id)}/>
                )}

                {displayWriteActions  && (
                    <>
                        <EditButton routeToEditPage={adminRoutes.muscle.edit(muscle.id)} />
                        <MuscleDeleteButton muscleId={muscle.id} callbackFunction={onConfirmDelete} />
                    </>
                )}
            </CardActions>
        </Card>
    );
}

export default MusclePreviewCard;