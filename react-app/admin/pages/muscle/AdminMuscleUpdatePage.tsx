import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {useParams} from "react-router-dom";
import useGetOneMuscleById from "app/common/hooks/muscle/useGetOneMuscleById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import AdminMuscleUpdateForm from "app/admin/features/muscle/AdminMuscleUpdateForm.tsx";

const AdminMuscleUpdatePage: React.FC = () => {
    const { muscleId } = useParams<{ muscleId: string }>();
    const muscle = useGetOneMuscleById(muscleId);
    if (!muscle) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <h3>{muscle.name} #{muscle.id}</h3>
            <AdminMuscleUpdateForm muscle={muscle} />
        </AdminLayout>
    )
}

export default AdminMuscleUpdatePage;