import React, { useEffect } from 'react';
import getOneUser from "../../gateway/UserGateway.tsx";
import UserDTO from "../../dtos/UserDTO.tsx";

const UserCardWidget: React.FC = () => {
    const [loading, setLoading] = React.useState<boolean>(true);
    const [user, setUser] = React.useState<UserDTO>();

    useEffect(() => {
        getOneUser(1)
            .then((user) => {
                setUser(user);
            })
            .finally(() => {
                setLoading(false);
            });
    });

    if (loading) {
        return <div>Chargement...</div>;
    }

    if (undefined !== user) {
        return (
            <div>
                <ul>
                    <li>Id: {user.id}</li>
                    <li>Login: {user.login}</li>
                    <li>Email: {user.email}</li>
                </ul>
            </div>
        );
    }

    return (
        <div>Not found</div>
    );
}

export default UserCardWidget;