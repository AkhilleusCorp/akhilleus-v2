import React, {useState} from "react";
import {Button, Card, CardActions, CardContent} from "@mui/material";
import ExerciseGroupDTO from "app/common/services/api/dtos/ExerciseGroupDTO.tsx";
import ExerciseApiGateway from "app/common/services/api/gateway/ExerciseApiGateway.tsx";
import ExerciseGroupDeleteButton from "app/common/features/exerciseGroup/ExerciseGroupDeleteButton.tsx";
import ExercisesPreviewListTable from "app/admin/features/exerciseGroup/ExercisesPreviewListTable.tsx";

type ExerciseGroupCardType = {
    group: ExerciseGroupDTO,
    displayWriteActions: boolean,
}

const ExerciseGroupCard: React.FC<ExerciseGroupCardType> = ({ group, displayWriteActions }) => {
    const [stateGroup, setStateGroup] = useState<ExerciseGroupDTO>(group);

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

    return (
        <Card id={"card-"+stateGroup.id} key={stateGroup.id} className={'margin-bottom-s'}>
            <CardContent>
                <div className={"margin-bottom-s"}>
                    { displayWriteActions && (
                        <div>
                            <ExerciseGroupDeleteButton workoutId={stateGroup.workoutId} exerciseGroupId={stateGroup.id} callbackFunction={onConfirmDelete}/>
                        </div>
                    )}
                </div>
                <ExercisesPreviewListTable movementConfigs={stateGroup.movementConfigs} exercises={stateGroup.exercises} />
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