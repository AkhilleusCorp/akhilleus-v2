import React, {useState} from "react";
import {Grid2 as Grid, Typography} from "@mui/material";
import ExerciseGroupCard from "./ExerciseGroupCard.tsx";
import ExerciseGroupAddButton from "./ExerciseGroupAddButton.tsx";
import useGetDropdownableMovements from "../../hooks/movement/useGetDropdownableMovements.tsx";
import ExerciseGroupDTO from "../../services/api/dtos/ExerciseGroupDTO.tsx";

type ExerciseGroupsListCardType = {
    workoutId: number,
    groups: ExerciseGroupDTO[],
    displayWriteActions: boolean
}

const ExerciseGroupsListCard: React.FC<ExerciseGroupsListCardType> = ({ workoutId, groups, displayWriteActions }) => {
    const [exerciseGroups, setExerciseGroups] = useState<ExerciseGroupDTO[]>(groups);
    const movements = useGetDropdownableMovements();

    const handleAddExerciseGroup = (group: ExerciseGroupDTO) => {
       setExerciseGroups(prevExerciseGroups => [...prevExerciseGroups, group]);
    }

    return (
        <>
            <Typography gutterBottom variant="h5" component="div" className={"margin-top-s"}>
                Exercises
            </Typography>
            { exerciseGroups.map((group: any) => (
                <div key={'div-'+group.id}>
                    <ExerciseGroupCard group={group} displayWriteActions={displayWriteActions} />
                </div>
            ))}

            <Grid container spacing={2} style={{justifyContent: 'center'}}>
                <ExerciseGroupAddButton workoutId={workoutId} type={'exercise'} movements={movements}
                                        callbackFunction={handleAddExerciseGroup}/>
                <ExerciseGroupAddButton workoutId={workoutId} type={'superset'} movements={movements}
                                        callbackFunction={handleAddExerciseGroup}/>
            </Grid>
        </>
    )
}

export default ExerciseGroupsListCard;