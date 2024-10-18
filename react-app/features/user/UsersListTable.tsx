import React, {useEffect, useState} from "react";
import {Paper, Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import UsersListFilters from "../../services/api/filters/UsersListFilters.tsx";
import userRegistries from "../../constants/userRegistries.tsx";
import { useSelector } from "react-redux";
import { AppDispatch, RootState } from "../../services/redux";
import { useDispatch } from "react-redux";
import { fetchUsers } from "../../services/redux/reducers/UserSlice.tsx";
import ApiResultWrapper from "../../components/common/ApiResultWrapper.tsx";
import PaginatedTableFooter from "../../components/table/PaginatedTableFooter.tsx";
import ListFilters from "../../services/api/filters/ListFilters.tsx";


type UsersListTableType = {
    filters: UsersListFilters;
    refreshKey: number;
    mainLinkClickCallback: (userId: number) => void;
}

const UsersListTable: React.FC<UsersListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { users, pagination, loading, error } = useSelector((state: RootState) => state.users);
    const dispatch = useDispatch<AppDispatch>();
    const [refresh, setRefresh] = useState<number>(refreshKey);

    useEffect(() => {
        dispatch(fetchUsers(filters));
    }, [dispatch, refresh]);

    const onUsernameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, userId: number) => {
        event.preventDefault();
        mainLinkClickCallback(userId);
    }

    const handlePagination = (paginationFilters: ListFilters) => {
        filters.page = paginationFilters.page;
        setRefresh(prev => prev + 1);
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
                </Table>
                <PaginatedTableFooter pagination={pagination} filters={filters} callbackFunction={handlePagination}/>
            </TableContainer>
        </ApiResultWrapper>
    );
}

export default UsersListTable;