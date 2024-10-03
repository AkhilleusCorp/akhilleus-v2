import React from "react";
import {Paper, Table, TableBody, TableCell, TableContainer, TableFooter, TableHead, TablePagination, TableRow} from '@mui/material';
import UsersListFilters from "../../services/api/filters/UsersListFilters.tsx";
import useGetManyUsersByParams from "../../hooks/user/useGetManyUserByParams.tsx";


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
        <TableContainer component={Paper}>
            <Table>
                <TableHead>
                    <TableRow>
                        <TableCell>id</TableCell>
                        <TableCell>username</TableCell>
                        <TableCell>status</TableCell>
                        <TableCell>email</TableCell>
                        <TableCell>type</TableCell>
                    </TableRow>
                </TableHead>
                <TableBody>
                    {users.map((user) => (
                        <TableRow id={'user_' + user.id} key={'user_' + user.id}>
                            <TableCell>{user.id}</TableCell>
                            <TableCell>
                                <a href={"#"} onClick={(event) => onUsernameClick(event, user.id)}>
                                    {user.username}
                                </a>
                            </TableCell>
                            <TableCell>{user.status}</TableCell>
                            <TableCell>{user.email}</TableCell>
                            <TableCell>{user.type}</TableCell>
                        </TableRow>
                        ))}
                </TableBody>
                <TableFooter>
                    <TableRow>
                        <TablePagination count={50} page={1} rowsPerPage={10} onPageChange={() => {console.log('clicked')}} />
                    </TableRow>
                </TableFooter>
            </Table>
        </TableContainer>
    );
}

export default UsersListTable;