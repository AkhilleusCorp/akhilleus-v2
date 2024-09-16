import axios, {AxiosResponse} from "axios";
import UserDTO from "../../dtos/UserDTO.tsx";
import {useEffect, useState} from "react";
import UsersListFilters from "../../filters/UsersListFilters.tsx";


function useGetManyUsersByParams(filters: UsersListFilters): UserDTO[] {
    const [users, setUsers] = useState<UserDTO[]>([]);
    useEffect(() => {
        const queryParams = objectToQueryParams(filters);
        const fetchUsers = async () => {
            const response: AxiosResponse<UserDTO[]> = await axios.get(`https://api.akhilleus.com:8000/api/users?${queryParams}`);
            setUsers(response.data);
        }

        fetchUsers();
    }, []);

    return users;
}

const objectToQueryParams = (params: { [key: string]: any }) => {
    return new URLSearchParams(params).toString();
};

export default useGetManyUsersByParams;