import React from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import {useParams} from "react-router-dom";
import useGetOneMovementById from "app/hooks/movement/useGetOneMovementById.tsx";
import ErrorPage from "app/pages/ErrorPage.tsx";
import MovementUpdateForm from "app/features/movement/MovementUpdateForm.tsx";
import MovementUpdateSource from "app/services/api/source/MovementUpdateSource.tsx";

const MovementUpdatePage: React.FC = () => {
    const { movementId } = useParams<{ movementId: string }>();
    const movement = useGetOneMovementById(movementId);
    if (!movement) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <h3>{movement.name} #{movement.id}</h3>
            <MovementUpdateForm movement={new MovementUpdateSource(movement)} />
        </AdminLayout>
    )
}

export default MovementUpdatePage;