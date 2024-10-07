import React from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import MovementsListFilters from "../../services/api/filters/MovementsListFilters.tsx";
import useGetManyMovementsByParams from "../../hooks/movement/useGetManyMovementByParams.tsx";
import movementRegistries from "../../constants/movementRegistries.tsx";


type MovementListTableType = {
    filters: MovementsListFilters;
    refreshKey: number;
    mainLinkClickCallback: (movementId: number) => void;
}

const MovementsListTable: React.FC<MovementListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const movements = useGetManyMovementsByParams(filters, refreshKey);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, movementId: number) => {
        event.preventDefault();
        mainLinkClickCallback(movementId);
    }

    return (
        <TableContainer component={Paper}>
            <Table>
                <TableHead>
                    <TableRow>
                        <TableCell>id</TableCell>
                        <TableCell>name</TableCell>
                        <TableCell>status</TableCell>
                        <TableCell>main muscle</TableCell>
                    </TableRow>
                </TableHead>
                <TableBody>
                    {movements.map((movement) => (
                        <TableRow id={'movement_' + movement.id} key={'movement_' + movement.id}>
                            <TableCell>{movement.id}</TableCell>
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
        </TableContainer>
    );
}

export default MovementsListTable;