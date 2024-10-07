import React, {useState} from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import {Link} from "react-router-dom";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import MovementsListFilters from "../../services/api/filters/MovementsListFilters.tsx";
import MovementDTO from "../../services/api/dtos/MovementDTO.tsx";
import MovementPreviewCard from "../../features/movement/MovementPreviewCard.tsx";
import MovementsSearchForm from "../../features/movement/MovementsSearchForm.tsx";
import MovementsListTable from "../../features/movement/MovementsListTable.tsx";
import MovementApiGateway from "../../services/api/gateway/MovementApiGateway.tsx";

const MovementsPage: React.FC = () => {
    const defaultFilters: MovementsListFilters = { ids: null, name: null, status: ['active'], muscleId: null, equipmentId: null, limit: 25 };
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
                <Link to={websiteRoutes.movement.create}>Create New Movement</Link>
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