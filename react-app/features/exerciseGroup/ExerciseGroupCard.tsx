import React from "react";
import {Card, CardContent, Typography} from "@mui/material";
import IndexedArray from "../../utils/interfaces/IndexedArray.tsx";
import ExercisesPreviewListTable from "./ExercisesPreviewListTable.tsx";
import ExerciseGroupDTO from "../../services/api/dtos/ExerciseGroupDTO.tsx";

type ExerciseGroupCardType = {
    group: ExerciseGroupDTO,
}

const ExerciseGroupCard: React.FC<ExerciseGroupCardType> = ({ group }) => {
    const movementNames: IndexedArray = {};

    group.exercises.map((exercise: any) => {
        movementNames[exercise.movementId] = exercise.movementName;
    });

    return (
        <Card key={group.id} className={'margin-bottom-s'}>
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    {group.movementIds.map((movementId: string) => (
                        <span key={group.id+'-'+movementId}>
                            {movementNames[movementId]}
                        </span>
                    ))}
                </Typography>
                <ExercisesPreviewListTable exercises={group.exercises} hasMultipleMovement={1 != group.movementIds.length}/>
            </CardContent>
        </Card>
    );
}

export default ExerciseGroupCard;