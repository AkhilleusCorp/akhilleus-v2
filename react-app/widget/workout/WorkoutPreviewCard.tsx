import React from 'react';
import EditButton from "../common/button/EditButton.tsx";
import websiteRoutes from "../../config/routes/website-routes.tsx";
import DetailsButton from "../common/button/DetailsButton.tsx";
import WorkoutDTO from "../../api/dtos/WorkoutDTO.tsx";
import {Card, CardActions, CardContent, Typography} from "@mui/material";

type WorkoutDetailsCardType = {
    workout: WorkoutDTO,
    displayActions: boolean
}

const WorkoutPreviewCard: React.FC<WorkoutDetailsCardType> = ({ workout, displayActions }) => {
    return (
        <Card>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    {workout.name}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    ID: {workout.id}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    Status: {workout.status}
                </Typography>
            </CardContent>

            {displayActions && (
                <CardActions>
                    <DetailsButton routeToDetailsPage={websiteRoutes.workout.details(workout.id)}/>
                    <EditButton routeToEditPage={websiteRoutes.workout.edit(workout.id)} />
                </CardActions>
            )}
        </Card>
    );
}

export default WorkoutPreviewCard;