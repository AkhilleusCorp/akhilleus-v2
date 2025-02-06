import React from 'react';
import {Card, CardContent, Typography} from "@mui/material";
import EquipmentDTO from "app/common/services/api/dtos/EquipmentDTO.tsx";
import equipmentRegistries from "app/common/constants/equipmentRegistries.tsx";

type EquipmentDetailsCardType = {
    equipment: EquipmentDTO
}

const EquipmentPreviewCard: React.FC<EquipmentDetailsCardType> = ({ equipment }) => {

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
        </Card>
    );
}

export default EquipmentPreviewCard;