class UserDTO {
    id: number;
    login: string;
    email: string;

    constructor(
        id: number,
        login: string,
        email: string,
    ) {
        this.id = id;
        this.login = login;
        this.email = email;
    }

}

export default UserDTO;