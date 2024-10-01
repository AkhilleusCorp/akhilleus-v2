import React from 'react';
import UserDTO from "../../api/dtos/UserDTO.tsx";
import {Card, CardContent, Typography} from "@mui/material";

type UserLifecycleCardType = {
    user: UserDTO,
}

const UserLifecycleCard: React.FC<UserLifecycleCardType> = ({ user }) => {
    return (
        <Card sx={{ marginTop: 2 }}>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    Lifecycle
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    <div>Registration: {user.registrationDate}</div>
                    <div>Modification: {user.lastModificationDate}</div>
                    <div>Login: {user.lastLoginDate}</div>
                    <div>Workout: {user.lastCompletedWorkoutDate}</div>
                </Typography>
            </CardContent>
        </Card>
    );
}

export default UserLifecycleCard;