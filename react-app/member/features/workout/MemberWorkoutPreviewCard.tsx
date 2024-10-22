import React from 'react';
import {Box, Card, CardActions, CardContent, CardMedia, Typography} from "@mui/material";
import WorkoutDTO from "app/admin/services/api/dtos/WorkoutDTO.tsx";
import workoutRegistries from "app/common/constants/workoutRegistries.tsx";
import memberRoutes from "app/member/services/router/memberRoutes.tsx";
import {useNavigate} from "react-router-dom";

type WorkoutDetailsCardType = {
    workout: WorkoutDTO,
}

const MemberWorkoutPreviewCard: React.FC<WorkoutDetailsCardType> = ({ workout }) => {
    const navigate = useNavigate();

    const navigateToDetails = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, workoutId: number) => {
        event.preventDefault();
        navigate(memberRoutes.workout.details(workoutId));
    }

    return (
        <Card>
            <Box  sx={{ display: 'flex' }}>
                <CardMedia
                    component="img"
                    sx={{ width: 151 }}
                    image="https://media.istockphoto.com/id/135895161/fr/photo/les-muscles-de-lanatomie-humaine-masculine.jpg?s=1024x1024&w=is&k=20&c=dJIzK-zTMfz0IrLJSGCfsYfkk7iTdr-DtKdEpUQOCeM="
                    alt="Live from space album cover"
                />
                <Box sx={{ display: 'flex', flexDirection: 'column' }}>
                    <CardContent>
                        <Typography gutterBottom variant="h5" component="div">
                            <a href={"#"} onClick={(event) => navigateToDetails(event, workout.id)}>
                                {workout.name}
                            </a>
                        </Typography>
                        <Typography variant="body2" sx={{color: 'text.secondary'}}>
                            Status: {workoutRegistries.status[workout.status]}
                        </Typography>
                    </CardContent>
                </Box>
            </Box>
            <CardActions>
                Actions
            </CardActions>
        </Card>
    );
}

export default MemberWorkoutPreviewCard;