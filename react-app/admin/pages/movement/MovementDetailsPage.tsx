import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import MovementPreviewCard from "app/admin/features/movement/MovementPreviewCard.tsx";
import {useParams} from "react-router-dom";
import useGetOneMovementById from "app/admin/hooks/movement/useGetOneMovementById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";

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