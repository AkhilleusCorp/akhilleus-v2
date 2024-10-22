import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import WorkoutUpdateForm from "app/admin/features/workout/WorkoutUpdateForm.tsx";
import {useParams} from "react-router-dom";
import useGetOneWorkoutById from "app/common/hooks/workout/useGetOneWorkoutById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import ExerciseGroupsListCard from "app/admin/features/exerciseGroup/ExerciseGroupsListCard.tsx";

const AdminWorkoutUpdatePage: React.FC = () => {
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

export default AdminWorkoutUpdatePage;