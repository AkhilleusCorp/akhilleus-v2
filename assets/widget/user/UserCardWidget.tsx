import React, {useEffect, useState} from 'react';
import UserDTO from "../../dtos/UserDTO.tsx";
import axios, {AxiosResponse} from "axios";
import {useParams} from "react-router-dom";

const UserCardWidget: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();
    const [user, setUser] = useState<UserDTO | null>(null);
    const [loading, setLoading] = useState<boolean>(true);
    const [error, setError] = useState<string | null>(null);

    const fetchUserData = async (userId: number) => {
        try {
            const response: AxiosResponse<UserDTO> = await axios.get(`https://api.akhilleus.com:8000/api/users/${userId}`);
            setUser(response.data);
        } catch (err) {
            setError('Impossible de récupérer les données utilisateur.');
            console.error(err);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        if (userId) {
            const numericUserId = parseInt(userId, 10); // Conversion du string en number
            if (!isNaN(numericUserId)) {
                fetchUserData(numericUserId); // Appel de la fonction avec un number
            } else {
                setError('ID utilisateur invalide.');
                setLoading(false);
            }
        }

    }, []);

    // Rendu du composant
    if (loading) {
        return <div>Chargement...</div>;
    }

    if (error) {
        return <div>{error}</div>;
    }

    return (
        <div>
            {user ? (
                <div>
                    <h1>{user.login} #{user.id}</h1>
                    <p>Email: {user.email}</p>
                </div>
            ) : (
                <p>Aucun utilisateur trouvé.</p>
            )}
        </div>
    );
}

export default UserCardWidget;