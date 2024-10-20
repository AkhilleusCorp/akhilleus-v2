import React, {useEffect, useState} from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import { useSelector, useDispatch } from "react-redux";
import ListFilters from "app/services/api/filters/ListFilters.tsx";
import WorkoutsListFilters from "app/services/api/filters/WorkoutsListFilters.tsx";
import {AppDispatch, RootState} from "app/services/redux";
import {fetchWorkouts} from "app/services/redux/reducers/WorkoutSlice.tsx";
import ApiResultWrapper from "app/components/common/ApiResultWrapper.tsx";
import workoutRegistries from "app/constants/workoutRegistries.tsx";
import PaginatedTableFooter from "app/components/table/PaginatedTableFooter.tsx";

type WorkoutListTableType = {
    filters: WorkoutsListFilters;
    refreshKey: number;
    mainLinkClickCallback: (workoutId: number) => void;
}

const UsersListTable: React.FC<WorkoutListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { workouts, pagination, loading, error } = useSelector((state: RootState) => state.workouts);
    const dispatch = useDispatch<AppDispatch>();
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