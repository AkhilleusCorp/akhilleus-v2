import React from "react";
import Table from "../common/table/Table.tsx";
import TableHead from "../common/table/TableHead.tsx";
import WorkoutsListFilters from "../../filters/WorkoutsListFilters.tsx";
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
        <Table>
            <TableHead headers={['id', 'name', 'status']} />
            <tbody>
            {workouts.map((workout) => (
                <tr id={'workout_' + workout.id} key={'workout_' + workout.id}>
                    <td>{workout.id}</td>
                    <td>
                        <a href={"#"} onClick={(event) => onNameClick(event, workout.id)}>
                            {workout.name}
                        </a>
                    </td>
                    <td>{workout.status}</td>
                </tr>
            ))}
            </tbody>
        </Table>
    );
}

export default UsersListTable;