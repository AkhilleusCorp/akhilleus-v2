import React, {useEffect, useState} from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import { useSelector, useDispatch } from "react-redux";
import ListFilters from "app/common/services/api/filters/ListFilters.tsx";
import AdminWorkoutsListFilters from "app/admin/services/api/filters/AdminWorkoutsListFilters.tsx";
import {AppDispatch, AppRootState} from "app/common/services/redux";
import {fetchWorkouts} from "app/common/services/redux/reducers/WorkoutSlice.tsx";
import ApiResultWrapper from "app/common/components/common/ApiResultWrapper.tsx";
import workoutRegistries from "app/common/constants/workoutRegistries.tsx";
import PaginatedTableFooter from "app/common/components/table/PaginatedTableFooter.tsx";
import {Link} from "react-router-dom";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";

type WorkoutListTableType = {
    filters: AdminWorkoutsListFilters;
    refreshKey: number;
}

const UsersListTable: React.FC<WorkoutListTableType> = ({ filters, refreshKey }) => {
    const { workouts, pagination, loading, error } = useSelector((state: AppRootState) => state.workouts);
    const dispatch = useDispatch<AppDispatch>();
    const [refresh, setRefresh] = useState<number>(refreshKey);

    useEffect(() => {
        dispatch(fetchWorkouts(filters));
    }, [dispatch, refresh]);

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
                                <Link to={adminRoutes.workout.details(workout.id)}>
                                    {workout.name}
                                </Link>
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