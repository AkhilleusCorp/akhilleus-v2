import React from 'react';
import {useParams} from "react-router-dom";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import useGetOneWorkoutById from "app/common/hooks/workout/useGetOneWorkoutById.tsx";
import MemberLayout from "app/member/layouts/MemberLayout.tsx";
import MemberWorkoutPreviewCard from "app/member/features/workout/MemberWorkoutPreviewCard.tsx";
import EditButton from "app/common/components/button/EditButton.tsx";
import memberRoutes from "app/member/services/router/memberRoutes.tsx";
import WorkoutDeleteButton from "app/common/features/workout/WorkoutDeleteButton.tsx";
import ExerciseGroupsListCard from "app/admin/features/exerciseGroup/ExerciseGroupsListCard.tsx";
import MemberWorkoutStartButton from "app/member/features/workout/MemberWorkoutStartButton.tsx";

const MemberWorkoutDetailsPage: React.FC = () => {
    const { workoutId } = useParams<{ workoutId: string }>();

    if (undefined == workoutId) {
        return <ErrorPage />
    }

    const workout = useGetOneWorkoutById(workoutId);
    if (!workout) {
        return <ErrorPage />
    }

    return (
        <MemberLayout>
            <>
                <MemberWorkoutStartButton workoutId={workout.id}  />
                <EditButton routeToEditPage={memberRoutes.workout.edit(workout.id)} />
                <WorkoutDeleteButton workoutId={workout.id} postDeleteTarget={memberRoutes.workout.list} />
            </>
            <MemberWorkoutPreviewCard workout={workout} />
            <ExerciseGroupsListCard workoutId={workout.id} displayWriteActions={false}/>
        </MemberLayout>
    )
}

export default MemberWorkoutDetailsPage;