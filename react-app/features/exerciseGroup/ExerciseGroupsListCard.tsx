import React from "react";
import {Typography} from "@mui/material";
import ExerciseGroupCard from "./ExerciseGroupCard.tsx";
import useGetExerciseGroupByWorkoutId from "../../hooks/exerciseGroup/useGetExerciseGroupByWorkoutId.tsx";

type ExerciseGroupsListCardType = {
    workoutId: string | undefined,
    displayWriteActions: boolean
}

const ExerciseGroupsListCard: React.FC<ExerciseGroupsListCardType> = ({ workoutId, displayWriteActions }) => {
    const exerciseGroups = useGetExerciseGroupByWorkoutId(workoutId);

    return (
        <>
            <Typography gutterBottom variant="h5" component="div">
                Exercises
            </Typography>
            { exerciseGroups.map((group: any) => (
                <div key={'div-'+group.id}>
                    <ExerciseGroupCard group={group} displayWriteActions={displayWriteActions} />
                </div>
            ))}
        </>
    )
}

export default ExerciseGroupsListCard;