import React from 'react';
import {Card, CardContent, Typography} from "@mui/material";
import WorkoutDTO from "app/common/services/api/dtos/WorkoutDTO.tsx";
import workoutRegistries from "app/common/constants/workoutRegistries.tsx";

type WorkoutDetailsCardType = {
    workout: WorkoutDTO,
    displayReadActions: boolean,
    displayWriteActions: boolean
}

const WorkoutPreviewCard: React.FC<WorkoutDetailsCardType> = ({ workout }) => {


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
        </Card>
    );
}

export default WorkoutPreviewCard;