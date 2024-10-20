import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import MusclePreviewCard from "app/admin/features/muscle/MusclePreviewCard.tsx";
import {useParams} from "react-router-dom";
import useGetOneMuscleById from "app/admin/hooks/muscle/useGetOneMuscleById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";

const MuscleDetailsPage: React.FC = () => {
    const { muscleId } = useParams<{ muscleId: string }>();

    const muscle = useGetOneMuscleById(muscleId);

    if (!muscle) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <MusclePreviewCard muscle={muscle} displayReadActions={false} displayWriteActions={true}/>
        </AdminLayout>
    );
}

export default MuscleDetailsPage;