import React, {useState} from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {Link} from "react-router-dom";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import AdminMovementsListFilters from "app/admin/services/api/filters/AdminMovementsListFilters.tsx";
import AdminMovementsSearchForm from "app/admin/features/movement/AdminMovementsSearchForm.tsx";
import AdminMovementsListTable from "app/admin/features/movement/AdminMovementsListTable.tsx";

const AdminMovementsPage: React.FC = () => {
    const defaultFilters= new AdminMovementsListFilters();
    const [filters, setFilters] = useState<AdminMovementsListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)

    const handleMovementsSearch = (filtersFromForm: AdminMovementsListFilters) => {
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
                <Link to={adminRoutes.movement.create}>Add New Movement</Link>
            </div>

            <AdminMovementsListTable filters={filters} refreshKey={refreshKey} />
        </AdminLayout>
    )
}

export default AdminMovementsPage;