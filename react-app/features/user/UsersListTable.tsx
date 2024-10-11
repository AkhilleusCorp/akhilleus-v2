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
    mainLinkClickCallback: (userId: number) => void
}

const UsersListTable: React.FC<UsersListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { users, loading, error } = useSelector((state: RootState) => state.users);
    const dispatch = useDispatch<AppDispatch>();

    useEffect(() => {
        dispatch(fetchUsers(filters));
    }, [dispatch, refreshKey]);

    const onUsernameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, userId: number) => {
        event.preventDefault();
        mainLinkClickCallback(userId);
    }

    return (
        <ApiResultWrapper loading={loading} error={error} hasPreviousLoad={users.length > 1}>
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
                            <TablePagination count={50} page={1} rowsPerPage={10} onPageChange={() => {console.log('clicked')}} />
                        </TableRow>
                    </TableFooter>
                </Table>
            </TableContainer>
        </ApiResultWrapper>
    );
}

export default UsersListTable;