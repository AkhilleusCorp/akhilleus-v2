import React from "react";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import useGetManyUsersByParams from "../../hooks/user/useGetManyUserByParams.tsx";

type UsersListTableType = {
    filters: UsersListFilters;
    refreshKey: number;
    displayUserPreview: (userId: number) => void
}

const UsersListTable: React.FC<UsersListTableType> = ({ filters, refreshKey, displayUserPreview }) => {
    const users = useGetManyUsersByParams(filters, refreshKey);

    const onClickDisplayPreview = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, userId: number) => {
        event.preventDefault();
        displayUserPreview(userId);
    }

    return (
        <div>
            <table>
                <thead>
                <tr>
                    <th>id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
                {users.map((user) => (
                    <tr id={'user_' + user.id} key={'user_' + user.id}>
                        <td>{user.id}</td>
                        <td>
                            <a href={"#"} onClick={(event) => onClickDisplayPreview(event, user.id)}>
                                {user.username}
                            </a>
                        </td>
                        <td>{user.email}</td>
                        <td>{user.type}</td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
}

export default UsersListTable;