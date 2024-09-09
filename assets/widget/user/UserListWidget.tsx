import React, { useState, useEffect } from 'react';
import axios, { AxiosResponse } from 'axios';
import UserDTO from "../../dtos/UserDTO.tsx";
import {Link} from "react-router-dom";

const UserListWidget: React.FC = () => {
    const [users, setUsers] = useState<UserDTO[]>([]);
    const [loading, setLoading] = useState<boolean>(true);
    const [error, setError] = useState<string | null>(null);

    const fetchUserList = async () => {
        try {
            const response: AxiosResponse<UserDTO[]> = await axios.get('https://api.akhilleus.com:8000/api/users');
            console.log(response.data);
            setUsers(response.data);
        } catch (err) {
            setError('Impossible de récupérer la liste des utilisateurs.');
            console.error(err);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchUserList();
    }, []);

    if (loading) {
        return <div>Chargement...</div>;
    }

    if (error) {
        return <div>{error}</div>;
    }

    return (
        <div>
            <h1>Liste des utilisateurs</h1>
            <ul>
                {users.map((user) => (
                    <li key={user.id}>
                        <Link to={"/users/"+user.id}>{user.login}</Link>
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default UserListWidget;