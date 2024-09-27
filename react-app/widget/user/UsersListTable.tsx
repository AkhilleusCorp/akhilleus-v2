import React from "react";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import useGetManyUsersByParams from "../../hooks/user/useGetManyUserByParams.tsx";
import Table from "../common/table/Table.tsx";
import TableHead from "../common/table/TableHead.tsx";


type UsersListTableType = {
    filters: UsersListFilters;
    refreshKey: number;
    mainLinkClickCallback: (userId: number) => void
}

const UsersListTable: React.FC<UsersListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const users = useGetManyUsersByParams(filters, refreshKey);

    const onUsernameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, userId: number) => {
        event.preventDefault();
        mainLinkClickCallback(userId);
    }

    return (
        <Table>
            <TableHead headers={['id', 'username', 'status', 'email', 'type']} />
            <tbody>
            {users.map((user) => (
                <tr id={'user_' + user.id} key={'user_' + user.id}>
                    <td>{user.id}</td>
                    <td>
                        <a href={"#"} onClick={(event) => onUsernameClick(event, user.id)}>
                            {user.username}
                        </a>
                    </td>
                    <td>{user.status}</td>
                    <td>{user.email}</td>
                    <td>{user.type}</td>
                </tr>
            ))}
            </tbody>
        </Table>
    );
}

export default UsersListTable;