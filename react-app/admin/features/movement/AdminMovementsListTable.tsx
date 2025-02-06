import React, {useEffect, useState} from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import { useSelector } from "react-redux";
import { useDispatch } from "react-redux";
import ListFilters from "app/common/services/api/filters/ListFilters.tsx";
import AdminMovementsListFilters from "app/admin/services/api/filters/AdminMovementsListFilters.tsx";
import {AppDispatch, AppRootState} from "app/common/services/redux";
import {fetchMovements} from "app/common/services/redux/reducers/MovementSlice.tsx";
import ApiResultWrapper from "app/common/components/common/ApiResultWrapper.tsx";
import movementRegistries from "app/common/constants/movementRegistries.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import PaginatedTableFooter from "app/common/components/table/PaginatedTableFooter.tsx";
import {Link} from "react-router-dom";

type MovementListTableType = {
    filters: AdminMovementsListFilters;
    refreshKey: number;
}

const AdminMovementsListTable: React.FC<MovementListTableType> = ({ filters, refreshKey }) => {
    const { movements, pagination, loading, error } = useSelector((state: AppRootState) => state.movements);
    const dispatch = useDispatch<AppDispatch>();
    const [refresh, setRefresh] = useState<number>(refreshKey);

    useEffect(() => {
        dispatch(fetchMovements(filters));
    }, [dispatch, refresh]);

    const handlePagination = (paginationFilters: ListFilters) => {
        filters.page = paginationFilters.page;
        setRefresh(prev => prev + 1);
    }

    return (
        <ApiResultWrapper loading={loading} error={error} hasPreviousPayload={movements.length > 1}>
            <TableContainer component={Paper}>
                <Table>
                    <TableHead>
                        <TableRow>
                            <TableCell>name</TableCell>
                            <TableCell>status</TableCell>
                            <TableCell>main muscle</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {movements.map((movement) => (
                            <TableRow id={'movement_' + movement.id} key={'movement_' + movement.id}>
                                <TableCell>
                                    <Link to={adminRoutes.movement.details(movement.id)}>
                                        {movement.name}
                                    </Link>
                                </TableCell>
                                <TableCell>{movementRegistries.status[movement.status]}</TableCell>
                                <TableCell>
                                    {movement.primaryMuscle.label}
                                </TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
                <PaginatedTableFooter pagination={pagination} filters={filters} callbackFunction={handlePagination}/>
            </TableContainer>
        </ApiResultWrapper>
    );
}

export default AdminMovementsListTable;