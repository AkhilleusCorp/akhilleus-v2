import React, { useEffect } from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import MusclesListFilters from "../../services/api/filters/MusclesListFilters.tsx";
import muscleRegistries from "../../constants/muscleRegistries.tsx";
import { useSelector } from "react-redux";
import { AppDispatch, RootState } from "../../services/redux/index.tsx";
import { useDispatch } from "react-redux";
import { fetchMuscles } from "../../services/redux/reducers/MuscleSlice.tsx";
import ApiResultWrapper from "../../components/common/ApiResultWrapper.tsx";


type MuscleListTableType = {
    filters: MusclesListFilters;
    refreshKey: number;
    mainLinkClickCallback: (muscleId: number) => void;
}

const MusclesListTable: React.FC<MuscleListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { muscles, loading, error } = useSelector((state: RootState) => state.muscles);
    const dispatch = useDispatch<AppDispatch>();

    useEffect(() => {
        dispatch(fetchMuscles(filters));
    }, [dispatch, refreshKey]);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, muscleId: number) => {
        event.preventDefault();
        mainLinkClickCallback(muscleId);
    }

    return (
        <ApiResultWrapper loading={loading} error={error} hasPreviousLoad={muscles.length > 1}>
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
                        {muscles.map((muscle) => (
                            <TableRow id={'muscle_' + muscle.id} key={'muscle_' + muscle.id}>
                                <TableCell>{muscle.id}</TableCell>
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
            </TableContainer>
        </ApiResultWrapper>
    );
}

export default MusclesListTable;