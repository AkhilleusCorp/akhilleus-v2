import React from 'react';
import UserDTO from "../../dtos/UserDTO.tsx";
import UserDetailsButton from "./UserDetailsButton.tsx";
import EditButton from "../common/button/EditButton.tsx";
import routes from "../../infrastructure/router/routes-mapping.tsx";

type UserDetailsCardType = {
    user: UserDTO,
    displayActions: boolean
}

const UserDetailsCard: React.FC<UserDetailsCardType> = ({ user, displayActions }) => {
    return (
        <div>
            <div className={"card"}>
                <div className={"card-body"}>
                    <div className={"card-image"}>
                        <img src={"https://placehold.co/150x150.png"} alt={"Avatar"}/>
                    </div>
                    <div className={"card-content"}>
                        <h3 className={"card-title"}>{user.username}</h3>
                        <div className={"card-description"}>
                            <div>ID: {user.id}</div>
                            <div>Email: {user.email}</div>
                        </div>
                    </div>
                </div>

                {displayActions && (
                    <div className={"card-footer"}>
                        <UserDetailsButton userId={user.id}/>
                        <EditButton routeToEditPage={routes.user.edit(user.id)} />
                    </div>
                )}
            </div>
        </div>
    );
}

export default UserDetailsCard;