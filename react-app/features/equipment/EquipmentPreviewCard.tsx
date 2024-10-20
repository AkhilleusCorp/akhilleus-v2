import React from 'react';
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import {useNavigate} from "react-router-dom";
import EquipmentDTO from "app/services/api/dtos/EquipmentDTO.tsx";
import websiteRoutes from "app/services/router/websiteRoutes.tsx";
import equipmentRegistries from "app/constants/equipmentRegistries.tsx";
import DetailsButton from "app/components/button/DetailsButton.tsx";
import EditButton from "app/components/button/EditButton.tsx";
import EquipmentDeleteButton from "app/features/equipment/EquipmentDeleteButton.tsx";

type EquipmentDetailsCardType = {
    equipment: EquipmentDTO,
    displayReadActions: boolean,
    displayWriteActions: boolean
}

const EquipmentPreviewCard: React.FC<EquipmentDetailsCardType> = ({ equipment, displayReadActions, displayWriteActions }) => {
    const navigate = useNavigate();

    const onConfirmDelete = () => {
        navigate(websiteRoutes.equipment.list);
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
                    <DetailsButton routeToDetailsPage={websiteRoutes.equipment.details(equipment.id)}/>
                )}

                {displayWriteActions  && (
                    <>
                        <EditButton routeToEditPage={websiteRoutes.equipment.edit(equipment.id)} />
                        <EquipmentDeleteButton equipmentId={equipment.id} callbackFunction={onConfirmDelete} />
                    </>
                )}
            </CardActions>
        </Card>
    );
}

export default EquipmentPreviewCard;