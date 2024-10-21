import React from 'react';
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import {useNavigate} from "react-router-dom";
import EquipmentDTO from "app/admin/services/api/dtos/EquipmentDTO.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import equipmentRegistries from "app/common/constants/equipmentRegistries.tsx";
import DetailsButton from "app/common/components/button/DetailsButton.tsx";
import EditButton from "app/common/components/button/EditButton.tsx";
import EquipmentDeleteButton from "app/admin/features/equipment/EquipmentDeleteButton.tsx";

type EquipmentDetailsCardType = {
    equipment: EquipmentDTO,
    displayReadActions: boolean,
    displayWriteActions: boolean
}

const EquipmentPreviewCard: React.FC<EquipmentDetailsCardType> = ({ equipment, displayReadActions, displayWriteActions }) => {
    const navigate = useNavigate();

    const onConfirmDelete = () => {
        navigate(adminRoutes.equipment.list);
    }

    return (
        <Card className={'margin-bottom-s'}>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    {equipment.name} #{equipment.id}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    Status: {equipmentRegistries.status[equipment.status]}
                </Typography>
            </CardContent>

            <CardActions>
                {displayReadActions && (
                    <DetailsButton routeToDetailsPage={adminRoutes.equipment.details(equipment.id)}/>
                )}

                {displayWriteActions  && (
                    <>
                        <EditButton routeToEditPage={adminRoutes.equipment.edit(equipment.id)} />
                        <EquipmentDeleteButton equipmentId={equipment.id} callbackFunction={onConfirmDelete} />
                    </>
                )}
            </CardActions>
        </Card>
    );
}

export default EquipmentPreviewCard;