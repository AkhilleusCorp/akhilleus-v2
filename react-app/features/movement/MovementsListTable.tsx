import React, {useEffect, useState} from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import { useSelector } from "react-redux";
import { useDispatch } from "react-redux";
import ListFilters from "app/services/api/filters/ListFilters.tsx";
import MovementsListFilters from "app/services/api/filters/MovementsListFilters.tsx";
import {AppDispatch, RootState} from "app/services/redux";
import {fetchMovements} from "app/services/redux/reducers/MovementSlice.tsx";
import ApiResultWrapper from "app/components/common/ApiResultWrapper.tsx";
import movementRegistries from "app/constants/movementRegistries.tsx";
import PaginatedTableFooter from "app/components/table/PaginatedTableFooter.tsx";

type MovementListTableType = {
    filters: MovementsListFilters;
    refreshKey: number;
    mainLinkClickCallback: (movementId: number) => void;
}

const MovementsListTable: React.FC<MovementListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { movements, pagination, loading, error } = useSelector((state: RootState) => state.movements);
    const dispatch = useDispatch<AppDispatch>();
    const [refresh, setRefresh] = useState<number>(refreshKey);

    useEffect(() => {
        dispatch(fetchMovements(filters));
    }, [dispatch, refresh]);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, movementId: number) => {
        event.preventDefault();
        mainLinkClickCallback(movementId);
    }

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
                                    <a href={"#"} onClick={(event) => onNameClick(event, movement.id)}>
                                        {movement.name}
                                    </a>
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

export default MovementsListTable;