import React, {useState} from "react";
import {Button, Card, CardActions, CardContent, Typography} from "@mui/material";
import IndexedArray from "../../utils/interfaces/IndexedArray.tsx";
import ExercisesPreviewListTable from "./ExercisesPreviewListTable.tsx";
import ExerciseGroupDTO from "../../services/api/dtos/ExerciseGroupDTO.tsx";
import ExerciseGroupDeleteButton from "./ExerciseGroupDeleteButton.tsx";
import ExerciseApiGateway from "../../services/api/gateway/ExerciseApiGateway.tsx";

type ExerciseGroupCardType = {
    group: ExerciseGroupDTO,
    displayWriteActions: boolean,
}

const ExerciseGroupCard: React.FC<ExerciseGroupCardType> = ({ group, displayWriteActions }) => {
    const movementNames: IndexedArray = {};
    const [stateGroup, setStateGroup] = useState<ExerciseGroupDTO>(group);

    stateGroup.exercises.map((exercise: any) => {
        movementNames[exercise.movementId] = exercise.movementName;
    });

    const onConfirmDelete = (groupId: number) => {
        const deletedCard = document.getElementById("card-"+groupId) as HTMLDivElement;
        deletedCard.className = 'toggle-content';
    }

    const handleAddExercises = async() => {
        try {
            const updatedGroup = await ExerciseApiGateway.addExercisesToGroup(group.workoutId, group.id);
            if (null !== updatedGroup) {
                setStateGroup(updatedGroup);
            }
        } catch (error) {
            console.log(error);
        }
    }

    const movementLabelPrefix = (index: number) => {
        if (index > 0) {
            return " / "
        }

        return "";
    }

    return (
        <Card id={"card-"+stateGroup.id} key={stateGroup.id} className={'margin-bottom-s'}>
            <CardContent>
                <div className={"margin-bottom-s"}>
                    <div className={"float-left two-thirds-width"}>
                        <Typography gutterBottom variant="h6" component="div">
                            {stateGroup.movementIds.map((movementId: string, index) => (
                                <span key={stateGroup.id + '-' + movementId}>
                                    {movementLabelPrefix(index)}{movementNames[movementId]}
                                </span>
                            ))}
                        </Typography>
                    </div>

                    { displayWriteActions && (
                        <div className={"float-right one-thirds-width text-align-right"}>
                            <ExerciseGroupDeleteButton workoutId={stateGroup.workoutId} exerciseGroupId={stateGroup.id} callbackFunction={onConfirmDelete}/>
                        </div>
                    )}
                </div>
                <ExercisesPreviewListTable exercises={stateGroup.exercises} hasMultipleMovement={1 != stateGroup.movementIds.length}/>
            </CardContent>
            <CardActions style={{justifyContent: 'center'}}>
                { displayWriteActions && (
                    <Button onClick={handleAddExercises} variant="outlined">Add set</Button>
                )}
            </CardActions>
        </Card>
    );
}

export default ExerciseGroupCard;