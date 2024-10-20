import React from "react";
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import {useNavigate} from "react-router-dom";
import UserDTO from "app/services/api/dtos/UserDTO.tsx";
import websiteRoutes from "app/services/router/websiteRoutes.tsx";
import userRegistries from "app/constants/userRegistries.tsx";
import DetailsButton from "app/components/button/DetailsButton.tsx";
import EditButton from "app/components/button/EditButton.tsx";
import UserDeleteButton from "app/features/user/UserDeleteButton.tsx";

type UserDetailsCardType = {
    user: UserDTO,
    displayReadActions: boolean,
    displayWriteActions: boolean
}

const UserPreviewCard: React.FC<UserDetailsCardType> = ({ user, displayReadActions, displayWriteActions }) => {
    const navigate = useNavigate();

    const onConfirmDelete = () => {
        navigate(websiteRoutes.user.list);
    }

    return (
        <Card>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    {user.username} #{user.id}
                </Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>
                    Status: {userRegistries.status[user.status]}
                </Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>
                    Email: {user.email}
                </Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>
                    Type: {userRegistries.type[user.type]}
                </Typography>
            </CardContent>

            <CardActions>
                {displayReadActions && (
                    <DetailsButton routeToDetailsPage={websiteRoutes.user.details(user.id)}/>
                )}

                {displayWriteActions && (
                    <>
                        <EditButton routeToEditPage={websiteRoutes.user.edit(user.id)}/>
                        <UserDeleteButton userId={user.id} callbackFunction={onConfirmDelete}/>
                    </>
                )}
            </CardActions>
        </Card>
    );
}

export default UserPreviewCard;