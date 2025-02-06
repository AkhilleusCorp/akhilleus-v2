import React from 'react';
import {Card, CardContent, Typography} from "@mui/material";
import MuscleDTO from "app/common/services/api/dtos/MuscleDTO.tsx";
import muscleRegistries from "app/common/constants/muscleRegistries.tsx";

type MuscleDetailsCardType = {
    muscle: MuscleDTO,
}

const MusclePreviewCard: React.FC<MuscleDetailsCardType> = ({ muscle }) => {
    return (
        <Card className={'margin-bottom-s'}>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    {muscle.name} #{muscle.id}
                </Typography>
                <Typography variant="body2" sx={{color: 'text.secondary'}}>
                    Status: {muscleRegistries.status[muscle.status]}
                </Typography>
            </CardContent>
        </Card>
    );
}

export default MusclePreviewCard;