import React from 'react';
import EditButton from "../../components/button/EditButton.tsx";
import websiteRoutes from "../../services/router/websiteRoutes.tsx";
import DetailsButton from "../../components/button/DetailsButton.tsx";
import EquipmentDTO from "../../services/api/dtos/EquipmentDTO.tsx";
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import EquipmentDeleteButton from "./EquipmentDeleteButton.tsx";
import {useNavigate} from "react-router-dom";
import equipmentRegistries from "../../constants/equipmentRegistries.tsx";

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