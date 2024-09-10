import React from "react";
import UserDTO from "../../dtos/UserDTO.tsx";

type UsersListWidget = {
    users: UserDTO[]
}

const UsersListWidget: React.FC<UsersListWidget> = ({ users }) => {

    return (
        <table>
            <tbody>
            { users.map((user) => (
                <tr key={'user_'+user.id}>
                    <td>{user.login}</td>
                </tr>
            ))}
            </tbody>
        </table>
    );
}

export default UsersListWidget;