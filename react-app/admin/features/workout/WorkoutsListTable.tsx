import React, {useEffect, useState} from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import { useSelector, useDispatch } from "react-redux";
import ListFilters from "app/common/services/api/filters/ListFilters.tsx";
import WorkoutsListFilters from "app/admin/services/api/filters/WorkoutsListFilters.tsx";
import {AdminDispatch, AdminRootState} from "app/admin/services/redux";
import {fetchWorkouts} from "app/common/services/redux/reducers/WorkoutSlice.tsx";
import ApiResultWrapper from "app/common/components/common/ApiResultWrapper.tsx";
import workoutRegistries from "app/common/constants/workoutRegistries.tsx";
import PaginatedTableFooter from "app/common/components/table/PaginatedTableFooter.tsx";

type WorkoutListTableType = {
    filters: WorkoutsListFilters;
    refreshKey: number;
    mainLinkClickCallback: (workoutId: number) => void;
}

const UsersListTable: React.FC<WorkoutListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { workouts, pagination, loading, error } = useSelector((state: AdminRootState) => state.workouts);
    const dispatch = useDispatch<AdminDispatch>();
    const [refresh, setRefresh] = useState<number>(refreshKey);

    useEffect(() => {
        dispatch(fetchWorkouts(filters));
    }, [dispatch, refresh]);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, workoutId: number) => {
        event.preventDefault();
        mainLinkClickCallback(workoutId);
    }

    const handlePagination = (paginationFilters: ListFilters) => {
        filters.page = paginationFilters.page;
        setRefresh(prev => prev + 1);
    }

    return (
        <ApiResultWrapper loading={loading} error={error} hasPreviousPayload={workouts.length > 1}>
            <TableContainer component={Paper}>
                <Table>
                    <TableHead>
                        <TableRow>
                            <TableCell>id</TableCell>
                            <TableCell>name</TableCell>
                            <TableCell>status</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                    {workouts.map((workout) => (
                        <TableRow id={'workout_' + workout.id} key={'workout_' + workout.id}>
                            <TableCell>{workout.id}</TableCell>
                            <TableCell>
                                <a href={"#"} onClick={(event) => onNameClick(event, workout.id)}>
                                    {workout.name}
                                </a>
                            </TableCell>
                            <TableCell>{workoutRegistries.status[workout.status]}</TableCell>
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