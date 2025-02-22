import React, {useEffect, useState} from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import { useSelector } from "react-redux";
import { useDispatch } from "react-redux";
import ListFilters from "app/common/services/api/filters/ListFilters.tsx";
import EquipmentsListFilters from "app/admin/services/api/filters/AdminEquipmentsListFilters.tsx";
import {AppDispatch, AppRootState} from "app/common/services/redux";
import {fetchEquipments} from "app/common/services/redux/reducers/EquipmentSlice.tsx";
import ApiResultWrapper from "app/common/components/common/ApiResultWrapper.tsx";
import equipmentRegistries from "app/common/constants/equipmentRegistries.tsx";
import PaginatedTableFooter from "app/common/components/table/PaginatedTableFooter.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import {Link} from "react-router-dom";

type EquipmentListTableType = {
    filters: EquipmentsListFilters;
    refreshKey: number;
}

const EquipmentsListTable: React.FC<EquipmentListTableType> = ({ filters, refreshKey }) => {
    const { equipments, pagination, loading, error } = useSelector((state: AppRootState) => state.equipments);
    const dispatch = useDispatch<AppDispatch>();
    const [refresh, setRefresh] = useState<number>(refreshKey);

    useEffect(() => {
        console.log("Equipment list");
        dispatch(fetchEquipments(filters));
    }, [dispatch, refresh]);

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
                                    <Link to={adminRoutes.equipment.details(equipment.id)}>
                                        {equipment.name}
                                    </Link>
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

export default EquipmentsListTable;