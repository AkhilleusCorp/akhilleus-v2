import React from 'react';
import EditButton from "../common/button/EditButton.tsx";
import websiteRoutes from "../../config/routes/website-routes.tsx";
import DetailsButton from "../common/button/DetailsButton.tsx";
import CardFooter from "../common/card/CardFooter.tsx";
import Card from "../common/card/Card.tsx";
import CardSideImageBody from "../common/card/CardSideImageBody.tsx";
import UserDTO from "../../api/dtos/UserDTO.tsx";

type UserDetailsCardType = {
    user: UserDTO,
    displayActions: boolean
}

const UserPreviewCard: React.FC<UserDetailsCardType> = ({ user, displayActions }) => {
    return (
        <Card>
            <CardSideImageBody imageSrc={"https://placehold.co/150x150.png"} imageAlt={"Avatar"}>
                <h3 className={"card-title"}>{user.username}</h3>
                <div className={"card-description"}>
                    <div>ID: {user.id}</div>
                    <div>Status: {user.status}</div>
                    <div>Email: {user.email}</div>
                    <div>Type: {user.type}</div>
                </div>
            </CardSideImageBody>

            <CardFooter shouldBeDisplayed={displayActions}>
                <DetailsButton routeToDetailsPage={websiteRoutes.user.details(user.id)}/>
                <EditButton routeToEditPage={websiteRoutes.user.edit(user.id)} />
            </CardFooter>
        </Card>
    );
}

export default UserPreviewCard;