import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import WorkoutDetailsCard from "../../widget/workout/WorkoutDetailsCard.tsx";
import {useNavigate, useParams} from "react-router-dom";
import ErrorPage from "../ErrorPage.tsx";
import useGetOneWorkoutById from "../../hooks/workout/useGetOneWorkoutById.tsx";
import EditButton from "../../widget/common/button/EditButton.tsx";
import routes from "../../infrastructure/router/routes-mapping.tsx";
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
        navigate(routes.workout.list);
    }

    return (
        <AdminLayout>
            <div className={"text-align-right margin-bottom-s"}>
                <EditButton routeToEditPage={routes.workout.edit(workout.id)}/>
                <WorkoutDeleteButton workoutId={workout.id} callbackFunction={onConfirmDelete} />
            </div>
            <WorkoutDetailsCard workout={workout} displayActions={false}/>
        </AdminLayout>
)
}

export default WorkoutDetailsPage;