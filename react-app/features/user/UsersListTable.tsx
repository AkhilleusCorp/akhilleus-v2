import React, { useEffect } from "react";
import {Paper, Table, TableBody, TableCell, TableContainer, TableFooter, TableHead, TablePagination, TableRow} from '@mui/material';
import UsersListFilters from "../../services/api/filters/UsersListFilters.tsx";
import userRegistries from "../../constants/userRegistries.tsx";
import { useSelector } from "react-redux";
import { AppDispatch, RootState } from "../../services/redux/index.tsx";
import { useDispatch } from "react-redux";
import { fetchUsers } from "../../services/redux/reducers/UserSlice.tsx";
import ApiResultWrapper from "../../components/common/ApiResultWrapper.tsx";


type UsersListTableType = {
    filters: UsersListFilters;
    refreshKey: number;
    mainLinkClickCallback: (userId: number) => void;
    callbackFunction: (filters: UsersListFilters) => void;
}

const UsersListTable: React.FC<UsersListTableType> = ({ filters, refreshKey, mainLinkClickCallback, callbackFunction }) => {
    const { users, loading, error } = useSelector((state: RootState) => state.users);
    const dispatch = useDispatch<AppDispatch>();

    useEffect(() => {
        dispatch(fetchUsers(filters));
    }, [dispatch, refreshKey]);

    const onUsernameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, userId: number) => {
        event.preventDefault();
        mainLinkClickCallback(userId);
    }

    const handlePageChange = (event: React.MouseEvent<HTMLButtonElement> | null, newPage: number) => {
        event?.preventDefault();
        console.log(newPage);
    }

    const handleRowsPerPageChange= (event: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>,) => {
        filters.limit = parseInt(event.target.value, 10);
        callbackFunction(filters);
    }

    return (
        <ApiResultWrapper loading={loading} error={error} hasPreviousPayload={users.length > 1}>
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
                                <TableCell>{userRegistries.status[user.status]}</TableCell>
                                <TableCell>{user.email}</TableCell>
                                <TableCell>{userRegistries.type[user.type]}</TableCell>
                            </TableRow>
                            ))}
                    </TableBody>
                    <TableFooter>
                        <TableRow>
                            <TablePagination count={50} page={1} rowsPerPage={filters.limit}
                                             onPageChange={handlePageChange}
                                             onRowsPerPageChange={handleRowsPerPageChange}/>
                        </TableRow>
                    </TableFooter>
                </Table>
            </TableContainer>
        </ApiResultWrapper>
    );
}

export default UsersListTable;