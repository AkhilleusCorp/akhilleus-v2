import React from 'react';
import UserDTO from "../../dtos/UserDTO.tsx";

type UserCardWidgetProps = {
    user: UserDTO
}

const UserCardWidget: React.FC<UserCardWidgetProps> = ({ user }) => {
    return (
        <div>
            <h1>{user.login} #{user.id}</h1>
            <p>Email: {user.email}</p>
        </div>
    );
}

export default UserCardWidget;