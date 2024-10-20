import React, {useEffect, useState} from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import { useSelector } from "react-redux";
import { useDispatch } from "react-redux";
import ListFilters from "app/services/api/filters/ListFilters.tsx";
import MusclesListFilters from "app/services/api/filters/MusclesListFilters.tsx";
import {AppDispatch, RootState} from "app/services/redux";
import {fetchMuscles} from "app/services/redux/reducers/MuscleSlice.tsx";
import ApiResultWrapper from "app/components/common/ApiResultWrapper.tsx";
import muscleRegistries from "app/constants/muscleRegistries.tsx";
import PaginatedTableFooter from "app/components/table/PaginatedTableFooter.tsx";

type MuscleListTableType = {
    filters: MusclesListFilters;
    refreshKey: number;
    mainLinkClickCallback: (muscleId: number) => void;
}

const MusclesListTable: React.FC<MuscleListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { muscles, pagination, loading, error } = useSelector((state: RootState) => state.muscles);
    const dispatch = useDispatch<AppDispatch>();
    const [refresh, setRefresh] = useState<number>(refreshKey);

    useEffect(() => {
        dispatch(fetchMuscles(filters));
    }, [dispatch, refresh]);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, muscleId: number) => {
        event.preventDefault();
        mainLinkClickCallback(muscleId);
    }

    const handlePagination = (paginationFilters: ListFilters) => {
        filters.page = paginationFilters.page;
        setRefresh(prev => prev + 1);
    }

    return (
        <ApiResultWrapper loading={loading} error={error} hasPreviousPayload={muscles.length > 1}>
            <TableContainer component={Paper}>
                <Table>
                    <TableHead>
                        <TableRow>
                            <TableCell>name</TableCell>
                            <TableCell>status</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {muscles.map((muscle) => (
                            <TableRow id={'muscle_' + muscle.id} key={'muscle_' + muscle.id}>
                                <TableCell>
                                    <a href={"#"} onClick={(event) => onNameClick(event, muscle.id)}>
                                        {muscle.name}
                                    </a>
                                </TableCell>
                                <TableCell>{muscleRegistries.status[muscle.status]}</TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
                <PaginatedTableFooter pagination={pagination} filters={filters} callbackFunction={handlePagination}/>
            </TableContainer>
        </ApiResultWrapper>
    );
}

export default MusclesListTable;