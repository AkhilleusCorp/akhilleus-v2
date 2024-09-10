import axios, {AxiosResponse} from "axios";
import UserDTO from "../../dtos/UserDTO.tsx";
import {useEffect, useState} from "react";


function useGetOneUseById(userId: string|undefined) {
    if (!userId) {
        return null;
    }

    const [user, setUser] = useState<UserDTO | null>(null);
    useEffect(() => {
        const fetchUser = async () => {
            const response: AxiosResponse<UserDTO> = await axios.get(`https://api.akhilleus.com:8000/api/users/${userId}`);
            setUser(response.data);
        }

        fetchUser();
    }, [userId]);

    return user;
}

export default useGetOneUseById;