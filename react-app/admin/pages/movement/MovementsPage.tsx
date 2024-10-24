import React, {useState} from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {Link} from "react-router-dom";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import MovementsListFilters from "app/admin/services/api/filters/MovementsListFilters.tsx";
import MovementDTO from "app/admin/services/api/dtos/MovementDTO.tsx";
import MovementPreviewCard from "app/admin/features/movement/MovementPreviewCard.tsx";
import MovementsSearchForm from "app/admin/features/movement/MovementsSearchForm.tsx";
import MovementsListTable from "app/admin/features/movement/MovementsListTable.tsx";
import MovementApiGateway from "app/admin/services/api/gateway/MovementApiGateway.tsx";

const MovementsPage: React.FC = () => {
    const defaultFilters= new MovementsListFilters();
    const [filters, setFilters] = useState<MovementsListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)
    const [movementPreview, setUserPreview] = useState<MovementDTO|null>(null);

    const handleDisplayUserPreview = async (movementId: number) => {
        const preview = await MovementApiGateway.getOneMovement(String(movementId));
        setUserPreview(preview);
    }

    const handleMovementsSearch = (filtersFromForm: MovementsListFilters) => {
        setFilters({
            ...filters,
            ...filtersFromForm
        });

        setRefreshKey(prev => prev + 1);
    }

    return (
        <AdminLayout>
            <h2>
                Movements list
            </h2>

            <div className={"margin-bottom-s"}>
                <MovementsSearchForm defaultFilters={defaultFilters} callbackFunction={handleMovementsSearch} />
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={adminRoutes.movement.create}>Create New Movement</Link>
            </div>

            <div className={"float-left two-thirds-width"}>
                <MovementsListTable filters={filters} refreshKey={refreshKey} mainLinkClickCallback={handleDisplayUserPreview}/>
            </div>

            <div className={"float-left padding-left-m one-thirds-width"}>
                {movementPreview && (
                    <MovementPreviewCard movement={movementPreview} displayReadActions={true} displayWriteActions={false}/>
                )}
            </div>
        </AdminLayout>
    )
}

export default MovementsPage;