import React, { useEffect } from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import WorkoutsListFilters from "../../services/api/filters/WorkoutsListFilters.tsx";
import workoutRegistries from "../../constants/workoutRegistries.tsx";
import { useSelector } from "react-redux";
import { AppDispatch, RootState } from "../../services/redux/index.tsx";
import { useDispatch } from "react-redux";
import { fetchWorkouts } from "../../services/redux/reducers/WorkoutSlice.tsx";
import ApiResultWrapper from "../../components/common/ApiResultWrapper.tsx";


type WorkoutListTableType = {
    filters: WorkoutsListFilters;
    refreshKey: number;
    mainLinkClickCallback: (workoutId: number) => void;
}

const UsersListTable: React.FC<WorkoutListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { workouts, loading, error } = useSelector((state: RootState) => state.workouts);
    const dispatch = useDispatch<AppDispatch>();

    useEffect(() => {
        dispatch(fetchWorkouts(filters));
    }, [dispatch, refreshKey]);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, workoutId: number) => {
        event.preventDefault();
        mainLinkClickCallback(workoutId);
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
            </TableContainer>
        </ApiResultWrapper>
    );
}

export default UsersListTable;