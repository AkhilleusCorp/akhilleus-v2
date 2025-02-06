import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import WorkoutPreviewCard from "app/common/features/workout/WorkoutPreviewCard.tsx";
import {useNavigate, useParams} from "react-router-dom";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import useGetOneWorkoutById from "app/common/hooks/workout/useGetOneWorkoutById.tsx";
import ExerciseGroupsListCard from "app/admin/features/exerciseGroup/ExerciseGroupsListCard.tsx";
import EditButton from "app/common/components/button/EditButton.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import WorkoutDeleteButton from "app/common/features/workout/WorkoutDeleteButton.tsx";

const AdminWorkoutDetailsPage: React.FC = () => {
    const { workoutId } = useParams<{ workoutId: string }>();
    const navigate = useNavigate();

    if (undefined == workoutId) {
        return <ErrorPage />
    }

    const workout = useGetOneWorkoutById(workoutId);
    if (!workout) {
        return <ErrorPage />
    }

    const onConfirmDelete = () => {
        navigate(adminRoutes.workout.list);
    }

    return (
        <AdminLayout>
            <>
                <EditButton routeToEditPage={adminRoutes.workout.edit(workout.id)} />
                <WorkoutDeleteButton workoutId={workout.id} callbackFunction={onConfirmDelete} />
            </>

            <WorkoutPreviewCard workout={workout} displayReadActions={false} displayWriteActions={true}/>
            <ExerciseGroupsListCard workoutId={workout.id} displayWriteActions={false}/>
        </AdminLayout>
    )
}

export default AdminWorkoutDetailsPage;