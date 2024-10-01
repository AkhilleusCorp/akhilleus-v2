import React from 'react';
import EditButton from "../common/button/EditButton.tsx";
import websiteRoutes from "../../config/routes/website-routes.tsx";
import DetailsButton from "../common/button/DetailsButton.tsx";
import UserDTO from "../../api/dtos/UserDTO.tsx";
import {Card, CardActions, CardContent, Typography} from "@mui/material";

type UserDetailsCardType = {
    user: UserDTO,
    displayActions: boolean
}

const UserPreviewCard: React.FC<UserDetailsCardType> = ({ user, displayActions }) => {
    return (
        <Card>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    {user.username}
                </Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>
                    <div>ID: {user.id}</div>
                    <div>Status: {user.status}</div>
                    <div>Email: {user.email}</div>
                    <div>Type: {user.type}</div>
                </Typography>
            </CardContent>

            {displayActions && (
                <CardActions>
                    <DetailsButton routeToDetailsPage={websiteRoutes.user.details(user.id)}/>
                    <EditButton routeToEditPage={websiteRoutes.user.edit(user.id)}/>
                </CardActions>
            )}
        </Card>
    );
}

export default UserPreviewCard;