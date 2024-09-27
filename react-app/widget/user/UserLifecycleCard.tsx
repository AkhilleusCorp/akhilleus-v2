import React from 'react';
import Card from "../common/card/Card.tsx";
import UserDTO from "../../api/dtos/UserDTO.tsx";
import CardEmptyBody from "../common/card/CardEmptyBody.tsx";

type UserLifecycleCardType = {
    user: UserDTO,
}

const UserLifecycleCard: React.FC<UserLifecycleCardType> = ({ user }) => {
    return (
        <Card>
            <CardEmptyBody title={"Lifecycle"}>
                <div className={"card-description"}>
                    <div>Registration: {user.registrationDate}</div>
                    <div>Modification: {user.lastModificationDate}</div>
                    <div>Login: {user.lastLoginDate}</div>
                    <div>Workout: {user.lastCompletedWorkoutDate}</div>
                </div>
            </CardEmptyBody>
        </Card>
    );
}

export default UserLifecycleCard;