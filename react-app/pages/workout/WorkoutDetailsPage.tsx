import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import WorkoutPreviewCard from "../../widget/workout/WorkoutPreviewCard.tsx";
import {useNavigate, useParams} from "react-router-dom";
import ErrorPage from "../ErrorPage.tsx";
import useGetOneWorkoutById from "../../hooks/workout/useGetOneWorkoutById.tsx";
import EditButton from "../../widget/common/button/EditButton.tsx";
import websiteRoutes from "../../config/routes/websiteRoutes.tsx";
import WorkoutDeleteButton from "../../widget/workout/WorkoutDeleteButton.tsx";

const WorkoutDetailsPage: React.FC = () => {
    const { workoutId } = useParams<{ workoutId: string }>();
    const navigate = useNavigate();

    const workout = useGetOneWorkoutById(workoutId);
    if (!workout) {
        return <ErrorPage />
    }

    const onConfirmDelete = (userId: number) => {
        console.log(userId);
        navigate(websiteRoutes.workout.list);
    }

    return (
        <AdminLayout>
            <div className={"text-align-right margin-bottom-s"}>
                <EditButton routeToEditPage={websiteRoutes.workout.edit(workout.id)}/>
                <WorkoutDeleteButton workoutId={workout.id} callbackFunction={onConfirmDelete} />
            </div>
            <WorkoutPreviewCard workout={workout} displayActions={false}/>
        </AdminLayout>
)
}

export default WorkoutDetailsPage;