import React, {useState} from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {Link} from "react-router-dom";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import MovementsListFilters from "app/admin/services/api/filters/MovementsListFilters.tsx";
import AdminMovementsSearchForm from "app/admin/features/movement/AdminMovementsSearchForm.tsx";
import AdminMovementsListTable from "app/admin/features/movement/AdminMovementsListTable.tsx";

const AdminMovementsPage: React.FC = () => {
    const defaultFilters= new MovementsListFilters();
    const [filters, setFilters] = useState<MovementsListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)

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
                <AdminMovementsSearchForm defaultFilters={defaultFilters} callbackFunction={handleMovementsSearch} />
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={adminRoutes.movement.create}>Create New Movement</Link>
            </div>

            <div className={"float-left two-thirds-width"}>
                <AdminMovementsListTable filters={filters} refreshKey={refreshKey} />
            </div>
        </AdminLayout>
    )
}

export default AdminMovementsPage;