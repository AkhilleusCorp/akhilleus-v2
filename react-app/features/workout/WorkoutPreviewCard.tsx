import React from 'react';
import EditButton from "../../components/button/EditButton.tsx";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import DetailsButton from "../../components/button/DetailsButton.tsx";
import WorkoutDTO from "../../services/api/dtos/WorkoutDTO.tsx";
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import WorkoutDeleteButton from "./WorkoutDeleteButton.tsx";
import {useNavigate} from "react-router-dom";
import workoutRegistries from "../../constants/workoutRegistries.tsx";

type WorkoutDetailsCardType = {
    workout: WorkoutDTO,
    displayReadActions: boolean,
    displayWriteActions: boolean
}

const WorkoutPreviewCard: React.FC<WorkoutDetailsCardType> = ({ workout, displayReadActions, displayWriteActions }) => {
    const navigate = useNavigate();

    const onConfirmDelete = () => {
        navigate(websiteRoutes.workout.list);
    }

    return (
        <Card className={'margin-bottom-s'}>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    {workout.name} #{workout.id}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    Status: {workoutRegistries.status[workout.status]}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    Visibility: {workoutRegistries.visibility[workout.visibility]}
                </Typography>

                { workout.duration && (
                    <Typography variant="body2" sx={{color: 'text.secondary'}}>
                        Duration: {workout.duration}
                    </Typography>
                )}

                { workout.endDate && (
                    <Typography variant="body2" sx={{color: 'text.secondary'}}>
                        Completed: {workout.endDate}
                    </Typography>
                )}

                { workout.plannedDate && (
                    <Typography variant="body2" sx={{color: 'text.secondary'}}>
                        Planned for: {workout.plannedDate}
                    </Typography>
                )}

            </CardContent>

            <CardActions>
                {displayReadActions && (
                    <DetailsButton routeToDetailsPage={websiteRoutes.workout.details(workout.id)}/>
                )}

                {displayWriteActions  && (
                    <>
                        <EditButton routeToEditPage={websiteRoutes.workout.edit(workout.id)} />
                        <WorkoutDeleteButton workoutId={workout.id} callbackFunction={onConfirmDelete} />
                    </>
                )}
            </CardActions>
        </Card>
    );
}

export default WorkoutPreviewCard;