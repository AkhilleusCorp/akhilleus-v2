import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import {useParams} from "react-router-dom";
import useGetOneMuscleById from "../../hooks/workout/useGetOneMuscleById.tsx";
import ErrorPage from "../ErrorPage.tsx";
import MuscleUpdateForm from "../../features/workout/MuscleUpdateForm.tsx";

const MuscleUpdatePage: React.FC = () => {
    const { muscleId } = useParams<{ muscleId: string }>();
    const muscle = useGetOneMuscleById(muscleId);
    if (!muscle) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <h3>{muscle.name} #{muscle.id}</h3>
            <MuscleUpdateForm muscle={muscle} />
        </AdminLayout>
    )
}

export default MuscleUpdatePage;