import UserDTO from "../../dtos/UserDTO.tsx";
import {useEffect, useState} from "react";
import UserAPI from "../../api/UserApi.tsx";


function useGetOneUseById(userId: string|undefined): UserDTO | null {
    if (!userId) {
        return null;
    }

    const [user, setUser] = useState<UserDTO | null>(null);
    useEffect(() => {
        const fetchUser = async () => {
            const user = await UserAPI.getOneUser(userId);
            setUser(user);
        }

        fetchUser();
    }, [userId]);

    return user;
}

export default useGetOneUseById;