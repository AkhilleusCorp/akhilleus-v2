import React from "react";
import {Link} from "react-router-dom";
import UserDeleteButton from "./UserDeleteButton.tsx";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import useGetManyUsersByParams from "../../hooks/user/useGetManyUserByParams.tsx";
import UserEditButton from "./UserEditButton.tsx";

type UsersListTableType = {
    filters: UsersListFilters;
    refreshKey: number;
}

const UsersListTable: React.FC<UsersListTableType> = ({ filters, refreshKey }) => {
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
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {users.map((user) => (
                <tr id={'user_' + user.id} key={'user_' + user.id}>
                    <td>{user.id}</td>
                    <td><Link to={'/users/' + user.id}>{user.login}</Link></td>
                    <td>{user.email}</td>
                    <td>
                        <UserEditButton userId={user.id} />
                        <UserDeleteButton userId={user.id} callbackFunction={removeUserLineFromTable}/>
                    </td>
                </tr>
            ))}
            </tbody>
        </table>
    );
}

export default UsersListTable;