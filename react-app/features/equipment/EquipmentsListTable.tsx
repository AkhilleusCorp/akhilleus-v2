import React, {useEffect, useState} from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import EquipmentsListFilters from "../../services/api/filters/EquipmentsListFilters.tsx";
import equipmentRegistries from "../../constants/equipmentRegistries.tsx";
import { useSelector } from "react-redux";
import { AppDispatch, RootState } from "../../services/redux";
import { useDispatch } from "react-redux";
import { fetchEquipments } from "../../services/redux/reducers/EquipmentSlice.tsx";
import ApiResultWrapper from "../../components/common/ApiResultWrapper.tsx";
import PaginatedTableFooter from "../../components/table/PaginatedTableFooter.tsx";
import ListFilters from "app/services/api/filters/ListFilters.tsx";

type EquipmentListTableType = {
    filters: EquipmentsListFilters;
    refreshKey: number;
    mainLinkClickCallback: (equipmentId: number) => void;
}

const EquipementsListTable: React.FC<EquipmentListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const { equipments, pagination, loading, error } = useSelector((state: RootState) => state.equipments);
    const dispatch = useDispatch<AppDispatch>();
    const [refresh, setRefresh] = useState<number>(refreshKey);

    useEffect(() => {
        dispatch(fetchEquipments(filters));
    }, [dispatch, refresh]);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, equipmentId: number) => {
        event.preventDefault();
        mainLinkClickCallback(equipmentId);
    }

    const handlePagination = (paginationFilters: ListFilters) => {
        filters.page = paginationFilters.page;
        setRefresh(prev => prev + 1);
    }

    return (
        <ApiResultWrapper loading={loading} error={error} hasPreviousPayload={equipments.length > 1}>
            <TableContainer component={Paper}>
                <Table>
                    <TableHead>
                        <TableRow>
                            <TableCell>name</TableCell>
                            <TableCell>status</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {equipments.map((equipment) => (
                            <TableRow id={'equipment_' + equipment.id} key={'equipment_' + equipment.id}>
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
                <PaginatedTableFooter pagination={pagination} filters={filters} callbackFunction={handlePagination}/>
            </TableContainer>
        </ApiResultWrapper>
    );
}

export default EquipementsListTable;