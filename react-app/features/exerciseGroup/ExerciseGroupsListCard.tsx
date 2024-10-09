import React, {useEffect} from "react";
import {Grid2 as Grid, Typography} from "@mui/material";
import ExerciseGroupCard from "./ExerciseGroupCard.tsx";
import ExerciseGroupAddButton from "./ExerciseGroupAddButton.tsx";
import useGetDropdownableMovements from "../../hooks/movement/useGetDropdownableMovements.tsx";
import { useSelector } from "react-redux";
import { useDispatch } from "react-redux";
import { AppDispatch, RootState } from "../../services/redux/index.tsx";
import { fetchExerciseGroups } from "../../services/redux/reducers/ExerciseGroupSlice.tsx";

type ExerciseGroupsListCardType = {
    workoutId: number,
    displayWriteActions: boolean
}

const ExerciseGroupsListCard: React.FC<ExerciseGroupsListCardType> = ({ workoutId, displayWriteActions }) => {
    const movements = useGetDropdownableMovements();

    const { exerciseGroups, loading, error } = useSelector((state: RootState) => state.exerciseGroups);
    const dispatch = useDispatch<AppDispatch>();

    useEffect(() => {
        dispatch(fetchExerciseGroups(workoutId));
    }, [dispatch]);

    return (
        <>
            <Typography gutterBottom variant="h5" component="div" className={"margin-top-s"}>
                Exercises
            </Typography>

            {loading && <p>Loading exercises...</p>}
            {error && <p style={{ color: 'red' }}>{error}</p>}
            
            { exerciseGroups.map((group: any) => (
                <div key={'div-'+group.id}>
                    <ExerciseGroupCard group={group} displayWriteActions={displayWriteActions} />
                </div>
            ))}

            <Grid container spacing={2} style={{justifyContent: 'center'}}>
                <ExerciseGroupAddButton workoutId={workoutId} type={'exercise'} movements={movements}/>
                <ExerciseGroupAddButton workoutId={workoutId} type={'superset'} movements={movements}/>
            </Grid>
        </>
    )
}

export default ExerciseGroupsListCard;