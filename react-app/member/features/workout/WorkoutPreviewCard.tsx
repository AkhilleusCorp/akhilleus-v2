import React from 'react';
import {Box, Card, CardContent, CardMedia, Typography} from "@mui/material";
import WorkoutDTO from "app/admin/services/api/dtos/WorkoutDTO.tsx";
import workoutRegistries from "app/common/constants/workoutRegistries.tsx";

type WorkoutDetailsCardType = {
    workout: WorkoutDTO,
}

const WorkoutPreviewCard: React.FC<WorkoutDetailsCardType> = ({ workout }) => {

    return (
        <Card sx={{ display: 'flex' }}>
            <Box sx={{ display: 'flex', flexDirection: 'column' }}>
                <CardContent>
                    <Typography gutterBottom variant="h5" component="div">
                        {workout.name} #{workout.id}
                    </Typography>
                    <Typography variant="body2" sx={{color: 'text.secondary'}}>
                        Status: {workoutRegistries.status[workout.status]}
                    </Typography>
                </CardContent>
                <CardMedia
                    component="img"
                    sx={{ width: 151 }}
                    image="https://media.istockphoto.com/id/135895161/fr/photo/les-muscles-de-lanatomie-humaine-masculine.jpg?s=1024x1024&w=is&k=20&c=dJIzK-zTMfz0IrLJSGCfsYfkk7iTdr-DtKdEpUQOCeM="
                    alt="Live from space album cover"
                />
            </Box>
        </Card>
    );
}

export default WorkoutPreviewCard;