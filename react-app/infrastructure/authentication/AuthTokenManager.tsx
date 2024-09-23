import axios from "axios";

class AuthTokenManager {

    private static host = 'https://website.akhilleus.com:8000/admin';

    static async getAuthToken (): Promise<string|null> {
        const response = await axios.head(this.host);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        if (undefined === response.headers.authorization) {
            return null;
        }

        return response.headers.authorization;
    }
}

export default AuthTokenManager;