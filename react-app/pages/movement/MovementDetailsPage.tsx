import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import MovementPreviewCard from "../../features/movement/MovementPreviewCard.tsx";
import {useParams} from "react-router-dom";
import useGetOneMovementById from "../../hooks/movement/useGetOneMovementById.tsx";
import ErrorPage from "../ErrorPage.tsx";

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