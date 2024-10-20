import React from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import MovementPreviewCard from "app/features/movement/MovementPreviewCard.tsx";
import {useParams} from "react-router-dom";
import useGetOneMovementById from "app/hooks/movement/useGetOneMovementById.tsx";
import ErrorPage from "app/pages/ErrorPage.tsx";

const MovementDetailsPage: React.FC = () => {
    const { movementId } = useParams<{ movementId: string }>();

    const movement = useGetOneMovementById(movementId);

    if (!movement) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <MovementPreviewCard movement={movement} displayReadActions={false} displayWriteActions={true}/>
        </AdminLayout>
    );
}

export default MovementDetailsPage;