import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import WorkoutUpdateForm from "../../widget/workout/WorkoutUpdateForm.tsx";
import {useParams} from "react-router-dom";
import useGetOneWorkoutById from "../../hooks/workout/useGetOneWorkoutById.tsx";
import ErrorPage from "../ErrorPage.tsx";

const WorkoutUpdatePage: React.FC = () => {
    const { workoutId } = useParams<{ workoutId: string }>();
    const workout = useGetOneWorkoutById(workoutId);
    if (!workout) {
        return <ErrorPage />
    }
    
    return (
        <AdminLayout>
            <WorkoutUpdateForm workout={workout} />
        </AdminLayout>
    )
}

export default WorkoutUpdatePage;