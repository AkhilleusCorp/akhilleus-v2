import React from "react";
import {Paper, Table,TableBody,TableCell, TableContainer, TableHead, TableRow} from '@mui/material';
import EquipmentsListFilters from "../../services/api/filters/EquipmentsListFilters.tsx";
import useGetManyEquipmentsByParams from "../../hooks/equipment/useGetManyEquipmentByParams.tsx";


type EquipmentListTableType = {
    filters: EquipmentsListFilters;
    refreshKey: number;
    mainLinkClickCallback: (equipmentId: number) => void;
}

const UsersListTable: React.FC<EquipmentListTableType> = ({ filters, refreshKey, mainLinkClickCallback }) => {
    const equipments = useGetManyEquipmentsByParams(filters, refreshKey);

    const onNameClick = (event: React.MouseEvent<HTMLAnchorElement, MouseEvent>, equipmentId: number) => {
        event.preventDefault();
        mainLinkClickCallback(equipmentId);
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
                    {equipments.map((equipment) => (
                        <TableRow id={'equipment_' + equipment.id} key={'equipment_' + equipment.id}>
                            <TableCell>{equipment.id}</TableCell>
                            <TableCell>
                                <a href={"#"} onClick={(event) => onNameClick(event, equipment.id)}>
                                    {equipment.name}
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