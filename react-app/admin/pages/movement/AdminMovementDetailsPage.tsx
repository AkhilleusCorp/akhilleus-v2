import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import MovementPreviewCard from "app/common/features/movement/MovementPreviewCard.tsx";
import {useNavigate, useParams} from "react-router-dom";
import useGetOneMovementById from "app/common/hooks/movement/useGetOneMovementById.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import EditButton from "app/common/components/button/EditButton.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import AdminMovementDeleteButton from "app/admin/features/movement/AdminMovementDeleteButton.tsx";

const AdminMovementDetailsPage: React.FC = () => {
    const { movementId } = useParams<{ movementId: string }>();
    const movement = useGetOneMovementById(movementId);
    const navigate = useNavigate();

    if (!movement) {
        return <ErrorPage />
    }

    const onConfirmDelete = () => {
        navigate(adminRoutes.movement.list);
    }

    return (
        <AdminLayout>
            <>
                <EditButton routeToEditPage={adminRoutes.movement.edit(movement.id)} />
                <AdminMovementDeleteButton movementId={movement.id} callbackFunction={onConfirmDelete} />
            </>
            <MovementPreviewCard movement={movement} />
        </AdminLayout>
    );
}

export default AdminMovementDetailsPage;