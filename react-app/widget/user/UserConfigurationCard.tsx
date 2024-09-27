import React from 'react';
import Card from "../common/card/Card.tsx";
import UserDTO from "../../api/dtos/UserDTO.tsx";
import CardEmptyBody from "../common/card/CardEmptyBody.tsx";

type UserConfigurationType = {
    user: UserDTO,
}

const UserConfigurationCard: React.FC<UserConfigurationType> = ({ user }) => {
    return (
        <Card>
            <CardEmptyBody title={"Configuration"}>
                <div className={"card-description"}>
                    <div>Date format: {user.dateFormat}</div>
                    <div>Weight unit: {user.weightUnit}</div>
                    <div>Distance unit: {user.distanceUnit}</div>
                    <div>Measurement unit: {user.measurementUnit}</div>
                </div>
            </CardEmptyBody>
        </Card>
    );
}

export default UserConfigurationCard;