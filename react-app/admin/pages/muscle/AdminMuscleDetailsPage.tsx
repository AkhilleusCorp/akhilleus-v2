import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import MusclePreviewCard from "app/common/features/muscle/MusclePreviewCard.tsx";
import {useParams} from "react-router-dom";
import useGetOneMuscleById from "app/common/hooks/muscle/useGetOneMuscleById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import EditButton from "app/common/components/button/EditButton.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import AdminMuscleDeleteButton from "app/admin/features/muscle/AdminMuscleDeleteButton.tsx";

const AdminMuscleDetailsPage: React.FC = () => {
    const { muscleId } = useParams<{ muscleId: string }>();
    const muscle = useGetOneMuscleById(muscleId);

    if (!muscle) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <>
                <EditButton routeToEditPage={adminRoutes.muscle.edit(muscle.id)} />
                <AdminMuscleDeleteButton muscleId={muscle.id} postDeleteTarget={adminRoutes.muscle.list} />
            </>
            <MusclePreviewCard muscle={muscle} />
        </AdminLayout>
    );
}

export default AdminMuscleDetailsPage;