import {useEffect, useState} from "react";
import UserApiGateway from "../../api/gateway/UserApiGateway.tsx";
import UserDTO from "../../api/dtos/UserDTO.tsx";

function useGetOneUserById(userId: string|undefined): UserDTO | null {
    if (!userId) {
        return null;
    }

    const [user, setUser] = useState<UserDTO | null>(null);
    useEffect(() => {
        const fetchUser = async () => {
            const user = await UserApiGateway.getOneUser(userId);
            setUser(user);
        }

        fetchUser();
    }, [userId]);

    return user;
}

export default useGetOneUserById;