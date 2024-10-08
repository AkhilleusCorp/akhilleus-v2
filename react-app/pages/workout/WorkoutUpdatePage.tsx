import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import WorkoutUpdateForm from "../../features/workout/WorkoutUpdateForm.tsx";
import {useParams} from "react-router-dom";
import useGetOneWorkoutById from "../../hooks/workout/useGetOneWorkoutById.tsx";
import ErrorPage from "../ErrorPage.tsx";
import ExerciseGroupsListCard from "../../features/exerciseGroup/ExerciseGroupsListCard.tsx";
import useGetExerciseGroupByWorkoutId from "../../hooks/exerciseGroup/useGetExerciseGroupByWorkoutId.tsx";

const WorkoutUpdatePage: React.FC = () => {
    const { workoutId } = useParams<{ workoutId: string }>();
    if (undefined === workoutId) {
        return <ErrorPage />
    }

    const workout = useGetOneWorkoutById(workoutId);
    const groups = useGetExerciseGroupByWorkoutId(workoutId);

    if (!workout) {
        return <ErrorPage />
    }
    
    return (
        <AdminLayout>
            <h3>{workout.name} #{workout.id}</h3>
            <WorkoutUpdateForm workout={workout} />
            <ExerciseGroupsListCard workoutId={workout.id} groups={groups} displayWriteActions={true}/>
        </AdminLayout>
    )
}

export default WorkoutUpdatePage;