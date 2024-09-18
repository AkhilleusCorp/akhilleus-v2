import React from 'react';
import UserDTO from "../../dtos/UserDTO.tsx";
import {Link} from "react-router-dom";

type UserDetailsCardType = {
    user: UserDTO,
    linkToDetails: boolean,
}

const UserDetailsCard: React.FC<UserDetailsCardType> = ({ user, linkToDetails }) => {
    return (
        <div>
            <h1>
                { linkToDetails && (
                    <Link to={'/users/'+user.id}>{user.login}</Link>
                )}

                { !linkToDetails && (
                    <span>{user.login} #{user.id}</span>
                )}
            </h1>
            <p>Email: {user.email}</p>
        </div>
    );
}

export default UserDetailsCard;