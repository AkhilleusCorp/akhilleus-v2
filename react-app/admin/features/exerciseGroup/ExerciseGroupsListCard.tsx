import React, {useEffect} from "react";
import {Grid2 as Grid, Typography} from "@mui/material";
import { useSelector } from "react-redux";
import { useDispatch } from "react-redux";
import useGetDropdownableMovements from "app/admin/hooks/movement/useGetDropdownableMovements.tsx";
import {AdminDispatch, AdminRootState} from "app/admin/services/redux";
import {fetchExerciseGroups} from "app/common/services/redux/reducers/ExerciseGroupSlice.tsx";
import ApiResultWrapper from "app/common/components/common/ApiResultWrapper.tsx";
import ExerciseGroupCard from "app/admin/features/exerciseGroup/ExerciseGroupCard.tsx";
import ExerciseGroupAddButton from "app/admin/features/exerciseGroup/ExerciseGroupAddButton.tsx";

type ExerciseGroupsListCardType = {
    workoutId: number,
    displayWriteActions: boolean
}

const ExerciseGroupsListCard: React.FC<ExerciseGroupsListCardType> = ({ workoutId, displayWriteActions }) => {
    const movements = useGetDropdownableMovements();

    const { exerciseGroups, loading, error } = useSelector((state: AdminRootState) => state.exerciseGroups);
    const dispatch = useDispatch<AdminDispatch>();

    useEffect(() => {
        dispatch(fetchExerciseGroups(workoutId));
    }, [dispatch]);

    return (
        <>
            <Typography gutterBottom variant="h5" component="div" className={"margin-top-s"}>
                Exercises
            </Typography>

            <ApiResultWrapper loading={loading} error={error} hasPreviousPayload={false}>
                { exerciseGroups.map((group: any) => (
                    <div key={'div-'+group.id}>
                        <ExerciseGroupCard group={group} displayWriteActions={displayWriteActions} />
                    </div>
                ))}

                { displayWriteActions && (
                    <Grid container spacing={2} style={{justifyContent: 'center'}}>
                        <ExerciseGroupAddButton workoutId={workoutId} type={'exercise'} movements={movements}/>
                        <ExerciseGroupAddButton workoutId={workoutId} type={'superset'} movements={movements}/>
                    </Grid>
                )}
            </ApiResultWrapper>
        </>
    )
}

export default ExerciseGroupsListCard;