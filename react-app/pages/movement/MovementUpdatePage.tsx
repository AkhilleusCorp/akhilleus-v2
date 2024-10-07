import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import {useParams} from "react-router-dom";
import useGetOneMovementById from "../../hooks/movement/useGetOneMovementById.tsx";
import ErrorPage from "../ErrorPage.tsx";
import MovementUpdateForm from "../../features/movement/MovementUpdateForm.tsx";
import MovementUpdateSource from "../../services/api/source/MovementUpdateSource.tsx";

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