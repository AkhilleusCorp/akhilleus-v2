import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import WorkoutPreviewCard from "app/admin/features/workout/WorkoutPreviewCard.tsx";
import {useParams} from "react-router-dom";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import useGetOneWorkoutById from "app/admin/hooks/workout/useGetOneWorkoutById.tsx";
import ExerciseGroupsListCard from "app/admin/features/exerciseGroup/ExerciseGroupsListCard.tsx";

const WorkoutDetailsPage: React.FC = () => {
    const { workoutId } = useParams<{ workoutId: string }>();
    if (undefined == workoutId) {
        return <ErrorPage />
    }

    const workout = useGetOneWorkoutById(workoutId);

    if (!workout) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <WorkoutPreviewCard workout={workout} displayReadActions={false} displayWriteActions={true}/>
            <ExerciseGroupsListCard workoutId={workout.id} displayWriteActions={false}/>
        </AdminLayout>
    )
}

export default WorkoutDetailsPage;