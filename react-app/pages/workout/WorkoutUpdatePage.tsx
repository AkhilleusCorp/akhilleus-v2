import React from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import WorkoutUpdateForm from "app/features/workout/WorkoutUpdateForm.tsx";
import {useParams} from "react-router-dom";
import useGetOneWorkoutById from "app/hooks/workout/useGetOneWorkoutById.tsx";
import ErrorPage from "app/pages/ErrorPage.tsx";
import ExerciseGroupsListCard from "app/features/exerciseGroup/ExerciseGroupsListCard.tsx";

const WorkoutUpdatePage: React.FC = () => {
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
            <h3>{workout.name} #{workout.id}</h3>
            <WorkoutUpdateForm workout={workout} />
            <ExerciseGroupsListCard workoutId={workout.id} displayWriteActions={true}/>
        </AdminLayout>
    )
}

export default WorkoutUpdatePage;