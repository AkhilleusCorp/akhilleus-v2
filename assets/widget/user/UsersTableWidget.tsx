import React from "react";
import {Link} from "react-router-dom";
import UserDTO from "../../dtos/UserDTO.tsx";
import UserDeleteWidget from "./UserDeleteWidget.tsx";

type UsersListWidget = {
    users: UserDTO[]
}

const UsersListWidget: React.FC<UsersListWidget> = ({ users }) => {
    const removeUserLineFromTable = (userId: number) => {
        const userLine = document.getElementById('user_'+userId) as HTMLTableRowElement;
        userLine.remove();
    }

    return (
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {users.map((user) => (
                <tr id={'user_'+user.id} key={'user_'+user.id}>
                    <td>{user.id}</td>
                    <td><Link to={'/users/'+user.id}>{user.login}</Link></td>
                    <td>{user.email}</td>
                    <th><UserDeleteWidget userId={user.id} callbackFunction={removeUserLineFromTable} /></th>
                </tr>
            ))}
            </tbody>
        </table>
    );
}

export default UsersListWidget;