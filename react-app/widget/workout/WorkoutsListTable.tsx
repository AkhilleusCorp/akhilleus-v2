import React from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import WorkoutsListFilters from "../../services/api/filters/WorkoutsListFilters.tsx";
import useGetManyWorkoutsByParams from "../../hooks/workout/useGetManyWorkoutByParams.tsx";


type WorkoutListTableType = {
    filters: WorkoutsListFilters;
    refreshKey: number;
    mainLinkClickCallback: (workoutId: number) => void;
}

const UsersListTable: React.FC<WorkoutListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const workouts = useGetManyWorkoutsByParams(filters, refreshKey);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, workoutId: number) => {
        event.preventDefault();
        mainLinkClickCallback(workoutId);
    }

    return (
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
                        <TableCell>{workout.status}</TableCell>
                    </TableRow>
                ))}
                </TableBody>
            </Table>
        </TableContainer>
    );
}

export default UsersListTable;