import axios, { AxiosResponse } from "axios";
import UserDTO from "../dtos/UserDTO.tsx";

async function getOneUser(id: number): Promise<UserDTO> {
    try {
        const response: AxiosResponse<UserDTO> = await axios.get(`https://localhost:8000/api/users/${id}`);
        return response.data;
    } catch (error) {
        console.error('Erreur lors de la récupération des données :', error);
        throw new Error('Impossible de récupérer les données');
    }
}

export default getOneUser;


/*
class UserGateway {
    endpoint: string;

    constructor() {
        this.endpoint = 'https://localhost:8000/api/users';
    }

    public getOne(id: number)
    {
        useEffect(() => {
            const [user, setUser] = useState<UserDTO>(null)
            axios.get(this.endpoint + '/' + id)
                .then(response => {
                    const user = new UserDTO(response.data.id, response.data.login, response.data.email);
                    setUser(user);
                })
                .catch(error => {
                    console.error(error);
                });
        }, []);

        return null;
    }
}

export default UserGateway;*/