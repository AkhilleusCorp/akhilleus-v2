import {useEffect, useState} from "react";
import AuthTokenManager from "../setup/authentication/AuthTokenManager.tsx";

function useGetAuthToken(): string | null {
    const [token, setToken] = useState<string|null>(null);
    useEffect(() => {
        const fetchToken = async () => {
            const token = await AuthTokenManager.getAuthToken();
            setToken(token);
        }

        fetchToken();
    }, []);

    return token;
}

export default useGetAuthToken;