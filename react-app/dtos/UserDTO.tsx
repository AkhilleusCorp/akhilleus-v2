class UserDTO {
    id: number;
    username: string;
    email: string;
    type: string;


    constructor(
        id: number,
        username: string,
        email: string,
        type: string,
    ) {
        this.id = id;
        this.username = username;
        this.email = email;
        this.type = type;
    }

}

export default UserDTO;