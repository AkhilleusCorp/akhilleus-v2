import React from 'react';
import UserDTO from "../../dtos/UserDTO.tsx";

type UserDetailsCardType = {
    user: UserDTO,
}

const UserDetailsCard: React.FC<UserDetailsCardType> = ({ user }) => {
    return (
        <div>
            <h1>
                <span>{user.login} #{user.id}</span>
            </h1>
            <p>Email: {user.email}</p>
        </div>
    );
}

export default UserDetailsCard;