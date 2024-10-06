import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import MusclePreviewCard from "../../features/muscle/MusclePreviewCard.tsx";
import {useParams} from "react-router-dom";
import useGetOneMuscleById from "../../hooks/muscle/useGetOneMuscleById.tsx";
import ErrorPage from "../ErrorPage.tsx";

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