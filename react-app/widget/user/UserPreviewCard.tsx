import React from 'react';
import EditButton from "../common/button/EditButton.tsx";
import websiteRoutes from "../../config/routes/websiteRoutes.tsx";
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

                <Typography variant="body2" sx={{ color: 'text.secondary' }}>ID: {user.id}</Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Status: {user.status}</Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Email: {user.email}</Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>Type: {user.type}</Typography>
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