import React from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import {useParams} from "react-router-dom";
import useGetOneMuscleById from "app/hooks/muscle/useGetOneMuscleById.tsx";
import ErrorPage from "app/pages/ErrorPage.tsx";
import MuscleUpdateForm from "app/features/muscle/MuscleUpdateForm.tsx";

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