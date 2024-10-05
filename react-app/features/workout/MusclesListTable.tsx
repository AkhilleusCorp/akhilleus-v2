import React from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import MusclesListFilters from "../../services/api/filters/MusclesListFilters.tsx";
import useGetManyMusclesByParams from "../../hooks/workout/useGetManyMuscleByParams.tsx";


type MuscleListTableType = {
    filters: MusclesListFilters;
    refreshKey: number;
    mainLinkClickCallback: (muscleId: number) => void;
}

const UsersListTable: React.FC<MuscleListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const muscles = useGetManyMusclesByParams(filters, refreshKey);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, muscleId: number) => {
        event.preventDefault();
        mainLinkClickCallback(muscleId);
    }

    return (
        <TableContainer component={Paper}>
            <Table>
                <TableHead>
                    <TableRow>
                        <TableCell>id</TableCell>
                        <TableCell>name</TableCell>
                    </TableRow>
                </TableHead>
                <TableBody>
                    {muscles.map((muscle) => (
                        <TableRow id={'muscle_' + muscle.id} key={'muscle_' + muscle.id}>
                            <TableCell>{muscle.id}</TableCell>
                            <TableCell>
                                <a href={"#"} onClick={(event) => onNameClick(event, muscle.id)}>
                                    {muscle.name}
                                </a>
                            </TableCell>
                        </TableRow>
                    ))}
                </TableBody>
            </Table>
        </TableContainer>
    );
}

export default UsersListTable;