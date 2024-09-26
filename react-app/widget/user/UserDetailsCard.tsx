import React from 'react';
import UserDTO from "../../dtos/UserDTO.tsx";
import EditButton from "../common/button/EditButton.tsx";
import routes from "../../infrastructure/router/routes-mapping.tsx";
import DetailsButton from "../common/button/DetailsButton.tsx";
import CardFooter from "../common/card/CardFooter.tsx";
import Card from "../common/card/Card.tsx";
import CardSideImageBody from "../common/card/CardSideImageBody.tsx";

type UserDetailsCardType = {
    user: UserDTO,
    displayActions: boolean
}

const UserDetailsCard: React.FC<UserDetailsCardType> = ({ user, displayActions }) => {
    return (
        <Card>
            <CardSideImageBody imageSrc={"https://placehold.co/150x150.png"} imageAlt={"Avatar"}>
                <h3 className={"card-title"}>{user.username}</h3>
                <div className={"card-description"}>
                    <div>ID: {user.id}</div>
                    <div>Email: {user.email}</div>
                </div>
            </CardSideImageBody>

            <CardFooter shouldBeDisplayed={displayActions}>
                <DetailsButton routeToDetailsPage={routes.user.details(user.id)}/>
                <EditButton routeToEditPage={routes.user.edit(user.id)} />
            </CardFooter>
        </Card>
    );
}

export default UserDetailsCard;