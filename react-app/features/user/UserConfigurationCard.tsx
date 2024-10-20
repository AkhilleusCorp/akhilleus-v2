import React from 'react';
import {Card, CardContent, Typography} from "@mui/material";
import UserDTO from "app/services/api/dtos/UserDTO.tsx";

type UserConfigurationType = {
    user: UserDTO,
}

const UserConfigurationCard: React.FC<UserConfigurationType> = ({ user }) => {
    return (
        <Card sx={{ marginTop: 2 }}>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    Configuration
                </Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Date format: {user.dateFormat}</Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Weight unit: {user.weightUnit}</Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Distance unit: {user.distanceUnit}</Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Measurement unit: {user.measurementUnit}</Typography>
            </CardContent>
        </Card>
    );
}

export default UserConfigurationCard;