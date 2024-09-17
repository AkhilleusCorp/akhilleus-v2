import React from "react";
import {Link} from "react-router-dom";
import UserDeleteWidget from "./UserDeleteWidget.tsx";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import useGetManyUsersByParams from "../../hooks/user/useGetManyUserByParams.tsx";

type UsersListAsTableWidgetProps = {
    filters: UsersListFilters;
    refreshKey: number;
}

const UsersListWidget: React.FC<UsersListAsTableWidgetProps> = ({ filters, refreshKey }) => {
    const users = useGetManyUsersByParams(filters, refreshKey);

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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {users.map((user) => (
                <tr id={'user_'+user.id} key={'user_'+user.id}>
                    <td>{user.id}</td>
                    <td><Link to={'/users/'+user.id}>{user.login}</Link></td>
                    <td><UserDeleteWidget userId={user.id} callbackFunction={removeUserLineFromTable} /></td>
                </tr>
            ))}
            </tbody>
        </table>
    );
}

export default UsersListWidget;