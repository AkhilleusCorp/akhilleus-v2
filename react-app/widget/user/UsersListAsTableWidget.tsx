import React from "react";
import {Link} from "react-router-dom";
import UserDeleteWidget from "./UserDeleteWidget.tsx";
import UsersListFilters from "../../filters/UsersListFilters.tsx";
import useGetManyUsersByParams from "../../hooks/user/useGetManyUserByParams.tsx";
import {Paper, TableContainer, Table, TableHead, TableRow, TableBody, TableCell} from "@mui/material";

type UsersListAsTableWidgetProps = {
    filters: UsersListFilters
}

const UsersListWidget: React.FC<UsersListAsTableWidgetProps> = ({ filters }) => {
    const users = useGetManyUsersByParams(filters);

    const removeUserLineFromTable = (userId: number) => {
        const userLine = document.getElementById('user_'+userId) as HTMLTableRowElement;
        userLine.remove();
    }

    return (
        <TableContainer component={Paper}>
            <Table sx={{ minWidth: 700 }} aria-label="customized table">
            <TableHead>
                <TableRow>
                    <TableCell>ID</TableCell>
                    <TableCell>Login</TableCell>
                    <TableCell>Actions</TableCell>
                </TableRow>
            </TableHead>

            <TableBody>
                {users.map((user) => (
                    <TableRow id={'user_'+user.id}>
                        <TableCell>{user.id}</TableCell>
                        <TableCell>
                            <Link to={'/users/'+user.id}>{user.login}</Link>
                        </TableCell>
                        <TableCell>
                            <UserDeleteWidget userId={user.id} callbackFunction={removeUserLineFromTable} />
                        </TableCell>
                    </TableRow>
                ))}
            </TableBody>
            </Table>
        </TableContainer>
    );
}

export default UsersListWidget;