                                                                                                                                                                                                                                                                                                import React from 'react';
import EditButton from "../../components/button/EditButton.tsx";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import DetailsButton from "../../components/button/DetailsButton.tsx";
import UserDTO from "../../services/api/dtos/UserDTO.tsx";
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import {useNavigate} from "react-router-dom";
import UserDeleteButton from "./UserDeleteButton.tsx";
import userRegistries from "../../constants/userRegistries.tsx";

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