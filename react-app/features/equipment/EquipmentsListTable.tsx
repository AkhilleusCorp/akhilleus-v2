import React, { useEffect } from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import EquipmentsListFilters from "../../services/api/filters/EquipmentsListFilters.tsx";
import equipmentRegistries from "../../constants/equipmentRegistries.tsx";
import { useSelector } from "react-redux";
import { AppDispatch, RootState } from "../../services/redux";
import { useDispatch } from "react-redux";
import { fetchEquipments } from "../../services/redux/reducers/EquipmentSlice.tsx";
import ApiResultWrapper from "../../components/common/ApiResultWrapper.tsx";


type EquipmentListTableType = {
    filters: EquipmentsListFilters;
    refreshKey: number;
    mainLinkClickCallback: (equipmentId: number) => void;
}

const EquipementsListTable: React.FC<EquipmentListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { equipments, loading, error } = useSelector((state: RootState) => state.equipments);
    const dispatch = useDispatch<AppDispatch>();

    useEffect(() => {
        dispatch(fetchEquipments(filters));
    }, [dispatch, refreshKey]);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, equipmentId: number) => {
        event.preventDefault();
        mainLinkClickCallback(equipmentId);
    }

    return (
        <ApiResultWrapper loading={loading} error={error} hasPreviousLoad={equipments.length > 1}>
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
                        {equipments.map((equipment) => (
                            <TableRow id={'equipment_' + equipment.id} key={'equipment_' + equipment.id}>
                                <TableCell>{equipment.id}</TableCell>
                                <TableCell>
                                    <a href={"#"} onClick={(event) => onNameClick(event, equipment.id)}>
                                        {equipment.name}
                                    </a>
                                </TableCell>
                                <TableCell>{equipmentRegistries.status[equipment.status]}</TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </TableContainer>
        </ApiResultWrapper>
    );
}

export default EquipementsListTable;