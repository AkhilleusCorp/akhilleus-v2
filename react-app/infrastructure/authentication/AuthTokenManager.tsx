import axios from "axios";

class AuthTokenManager {

    private static host = 'https://website.akhilleus.com:8000/authentication/token';

    static async getAuthToken (): Promise<string|null> {
        const response = await axios.get(this.host);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        if (undefined === response.data.token) {
            return null;
        }

        return response.data.token;
    }
}

export default AuthTokenManager;