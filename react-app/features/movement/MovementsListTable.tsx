import React, { useEffect } from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import MovementsListFilters from "../../services/api/filters/MovementsListFilters.tsx";
import movementRegistries from "../../constants/movementRegistries.tsx";
import { useSelector } from "react-redux";
import { AppDispatch, RootState } from "../../services/redux/index.tsx";
import { useDispatch } from "react-redux";
import { fetchMovements } from "../../services/redux/reducers/MovementSlice.tsx";
import ApiResultWrapper from "../../components/common/ApiResultWrapper.tsx";


type MovementListTableType = {
    filters: MovementsListFilters;
    refreshKey: number;
    mainLinkClickCallback: (movementId: number) => void;
}

const MovementsListTable: React.FC<MovementListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { movements, loading, error } = useSelector((state: RootState) => state.movements);
    const dispatch = useDispatch<AppDispatch>();

    useEffect(() => {
        dispatch(fetchMovements(filters));
    }, [dispatch, refreshKey]);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, movementId: number) => {
        event.preventDefault();
        mainLinkClickCallback(movementId);
    }

    return (
        <ApiResultWrapper loading={loading} error={error} hasPreviousPayload={movements.length > 1}>
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
        </ApiResultWrapper>
    );
}

export default MovementsListTable;