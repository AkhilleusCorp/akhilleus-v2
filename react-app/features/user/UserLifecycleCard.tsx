import React from 'react';
import UserDTO from "../../services/api/dtos/UserDTO.tsx";
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

                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Registration: {user.registrationDate}</Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Modification: {user.lastModificationDate}</Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Login: {user.lastLoginDate}</Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Workout: {user.lastCompletedWorkoutDate}</Typography>
            </CardContent>
        </Card>
    );
}

export default UserLifecycleCard;