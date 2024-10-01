import React from 'react';
import UserDTO from "../../api/dtos/UserDTO.tsx";
import {Card, CardContent, Typography} from "@mui/material";

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
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    <div>Date format: {user.dateFormat}</div>
                    <div>Weight unit: {user.weightUnit}</div>
                    <div>Distance unit: {user.distanceUnit}</div>
                    <div>Measurement unit: {user.measurementUnit}</div>
                </Typography>
            </CardContent>
        </Card>
    );
}

export default UserConfigurationCard;