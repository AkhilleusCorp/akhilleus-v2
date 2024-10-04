import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import WorkoutPreviewCard from "../../features/workout/WorkoutPreviewCard.tsx";
import {useNavigate, useParams} from "react-router-dom";
import ErrorPage from "../ErrorPage.tsx";
import useGetOneWorkoutById from "../../hooks/workout/useGetOneWorkoutById.tsx";
import EditButton from "../../components/button/EditButton.tsx";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import WorkoutDeleteButton from "../../features/workout/WorkoutDeleteButton.tsx";
import useGetExerciseGroupsByWorkoutId from "../../hooks/workout/useGetExerciseGroupsByWorkoutId.tsx";
import ExerciseGroupCard from "../../features/exerciseGroup/ExerciseGroupCard.tsx";
import {Typography} from "@mui/material";

const WorkoutDetailsPage: React.FC = () => {
    const { workoutId } = useParams<{ workoutId: string }>();
    const navigate = useNavigate();

    const workout = useGetOneWorkoutById(workoutId);
    const exerciseGroups = useGetExerciseGroupsByWorkoutId(workoutId);

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

            <Typography gutterBottom variant="h5" component="div">
                Exercises
            </Typography>
            { exerciseGroups.map((group: any) => (
                <div key={'div-'+group.id}>
                    <ExerciseGroupCard group={group} />
                </div>
            ))}
        </AdminLayout>
)
}

export default WorkoutDetailsPage;