import React, {useState} from "react";
import {Button, Card, CardActions, CardContent, Typography} from "@mui/material";
import ExerciseGroupDTO from "app/common/services/api/dtos/ExerciseGroupDTO.tsx";
import ExerciseApiGateway from "app/common/services/api/gateway/ExerciseApiGateway.tsx";
import ExerciseGroupDeleteButton from "app/common/features/exerciseGroup/ExerciseGroupDeleteButton.tsx";
import ExercisesPreviewListTable from "app/admin/features/exerciseGroup/ExercisesPreviewListTable.tsx";
import IndexedArray from "app/common/utils/interfaces/IndexedArray.tsx";

type ExerciseGroupCardType = {
    group: ExerciseGroupDTO,
    displayWriteActions: boolean,
}

const ExerciseGroupCard: React.FC<ExerciseGroupCardType> = ({ group, displayWriteActions }) => {
    const [stateGroup, setStateGroup] = useState<ExerciseGroupDTO>(group);
    const movementNames: IndexedArray = {};

    Object.keys(stateGroup.movementConfigs).forEach(movementConfigKey => {
        const key: number = +movementConfigKey;
        movementNames[movementConfigKey] = stateGroup.movementConfigs[key].name;
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

                <Typography variant="h6" component="div">
                    { Object.values(movementNames).join(' / ') }
                </Typography>

                <div className={"float-left one-thirds-width"}>
                    INSERT IMAGE HERE
                </div>

                <div className={"float-left two-thirds-width"}>
                    <ExercisesPreviewListTable movementConfigs={stateGroup.movementConfigs} movementNames={movementNames} exercises={stateGroup.exercises} />
                </div>
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