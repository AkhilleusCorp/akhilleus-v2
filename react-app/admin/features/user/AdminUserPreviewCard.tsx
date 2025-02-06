import React from "react";
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import UserDTO from "app/common/services/api/dtos/UserDTO.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import userRegistries from "app/common/constants/userRegistries.tsx";
import DetailsButton from "app/common/components/button/DetailsButton.tsx";

type UserDetailsCardType = {
    user: UserDTO,
    displayReadActions: boolean
}

const AdminUserPreviewCard: React.FC<UserDetailsCardType> = ({ user, displayReadActions }) => {
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
                    <DetailsButton routeToDetailsPage={adminRoutes.user.details(user.id)}/>
                )}
            </CardActions>
        </Card>
    );
}

export default AdminUserPreviewCard;