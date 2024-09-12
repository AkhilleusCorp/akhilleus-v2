import axios, {AxiosResponse} from "axios";
import UserDTO from "../../dtos/UserDTO.tsx";
import {useEffect, useState} from "react";


function useGetManyUsersByParams(): UserDTO[] {
    const [users, setUsers] = useState<UserDTO[]>([]);
    useEffect(() => {
        const fetchUsers = async () => {
            const response: AxiosResponse<UserDTO[]> = await axios.get(`https://api.akhilleus.com:8000/api/users`);
            setUsers(response.data);
        }

        fetchUsers();
    }, []);

    return users;
}

export default useGetManyUsersByParams;