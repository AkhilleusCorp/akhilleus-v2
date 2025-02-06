import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {useParams} from "react-router-dom";
import useGetOneMovementById from "app/common/hooks/movement/useGetOneMovementById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import AdminMovementUpdateForm from "app/admin/features/movement/AdminMovementUpdateForm.tsx";
import MovementUpdateSource from "app/admin/services/api/source/MovementUpdateSource.tsx";

const AdminMovementUpdatePage: React.FC = () => {
    const { movementId } = useParams<{ movementId: string }>();
    const movement = useGetOneMovementById(movementId);
    if (!movement) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <h3>{movement.name} #{movement.id}</h3>
            <AdminMovementUpdateForm movement={new MovementUpdateSource(movement)} />
        </AdminLayout>
    )
}

export default AdminMovementUpdatePage;