import React from 'react';
import {useParams} from "react-router-dom";
import useGetOneWorkoutById from "app/common/hooks/workout/useGetOneWorkoutById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import MemberLayout from "app/member/layouts/MemberLayout.tsx";
import WorkoutUpdateForm from "app/common/features/workout/WorkoutUpdateForm.tsx";
import ExerciseGroupsListCard from "app/admin/features/exerciseGroup/ExerciseGroupsListCard.tsx";

const MemberWorkoutUpdatePage: React.FC = () => {
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
            <h3>{workout.name} #{workout.id}</h3>
            <WorkoutUpdateForm workout={workout} userType={'member'} />
            <ExerciseGroupsListCard workoutId={workout.id} displayWriteActions={true}/>
        </MemberLayout>
    );
}

export default MemberWorkoutUpdatePage;