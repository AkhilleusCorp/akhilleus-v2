import UserDTO from "../../dtos/UserDTO.tsx";
import {useEffect, useState} from "react";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import UserAPI from "../../api/UserApi.tsx";


function useGetManyUsersByParams(filters: UsersListFilters): UserDTO[] {
    const [users, setUsers] = useState<UserDTO[]>([]);
    useEffect(() => {
        const fetchUsers = async () => {
            const users= await UserAPI.getManyUsers(filters);
            setUsers(users);
        }

        fetchUsers();
    }, []);

    return users;
}

export default useGetManyUsersByParams;