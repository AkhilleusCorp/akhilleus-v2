import {useEffect, useState} from "react";
import UsersListFilters from "../../interfaces/filters/UsersListFilters.tsx";
import UserApiGateway from "../../api/gateway/UserApiGateway.tsx";
import UserDTO from "../../api/dtos/UserDTO.tsx";


function useGetManyUsersByParams(filters: UsersListFilters, refreshKey: number): UserDTO[] {
    const [users, setUsers] = useState<UserDTO[]>([]);
    useEffect(() => {
        const fetchUsers = async () => {
            const users= await UserApiGateway.getManyUsers(filters);
            setUsers(users);
        }

        fetchUsers();
    }, [refreshKey]);

    return users;
}

export default useGetManyUsersByParams;