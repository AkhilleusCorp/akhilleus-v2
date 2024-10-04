import React from "react";
import {Card, CardActions, CardContent, Typography} from "@mui/material";
import IndexedArray from "../../utils/interfaces/IndexedArray.tsx";
import ExercisesPreviewListTable from "./ExercisesPreviewListTable.tsx";
import ExerciseGroupDTO from "../../services/api/dtos/ExerciseGroupDTO.tsx";
import ExerciseGroupDeleteButton from "./ExerciseGroupDeleteButton.tsx";

type ExerciseGroupCardType = {
    group: ExerciseGroupDTO,
    displayWriteActions: boolean,
}

const ExerciseGroupCard: React.FC<ExerciseGroupCardType> = ({ group, displayWriteActions }) => {
    const movementNames: IndexedArray = {};

    group.exercises.map((exercise: any) => {
        movementNames[exercise.movementId] = exercise.movementName;
    });

    const onConfirmDelete = (groupId: number) => {
        const deletedCard = document.getElementById("card-"+groupId) as HTMLDivElement;
        deletedCard.className = 'toggle-content';
    }

    return (
        <Card id={"card-"+group.id} key={group.id} className={'margin-bottom-s'}>
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
            <CardActions>
                { displayWriteActions && (
                    <>
                        <ExerciseGroupDeleteButton workoutId={group.workoutId} exerciseGroupId={group.id} callbackFunction={onConfirmDelete}/>
                    </>
                )}
            </CardActions>
        </Card>
    );
}

export default ExerciseGroupCard;