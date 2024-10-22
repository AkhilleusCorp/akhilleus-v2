import {useDispatch, useSelector} from "react-redux";
import React, {useEffect} from "react";
import WorkoutsListFilters from "app/admin/services/api/filters/WorkoutsListFilters.tsx";
import ApiResultWrapper from "app/common/components/common/ApiResultWrapper.tsx";
import {fetchWorkouts} from "app/common/services/redux/reducers/WorkoutSlice.tsx";
import {MemberDispatch, MemberRootState} from "app/member/services/redux";
import MemberWorkoutPreviewCard from "app/member/features/workout/MemberWorkoutPreviewCard.tsx";
import {Stack} from "@mui/material";
import WorkoutDTO from "app/admin/services/api/dtos/WorkoutDTO.tsx";

type WorkoutListCardType = {
    filters: WorkoutsListFilters;
    refreshKey: number;
}

const MemberWorkoutListCard: React.FC<WorkoutListCardType> = ({ filters, refreshKey }) => {
    const {workouts, loading, error} = useSelector((state: MemberRootState) => state.workouts);
    const dispatch = useDispatch<MemberDispatch>();

    useEffect(() => {
        dispatch(fetchWorkouts(filters));
    }, [dispatch, refreshKey]);

    return (
        <ApiResultWrapper loading={loading} error={error} hasPreviousPayload={workouts.length > 1}>
            <Stack spacing={2}>
                {workouts.map((workout: WorkoutDTO) => (
                    <div key={"key-" + workout.id}>
                        <MemberWorkoutPreviewCard workout={workout} />
                    </div>
                ))}
            </Stack>
        </ApiResultWrapper>
    );
}

export default MemberWorkoutListCard;