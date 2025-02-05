import React, {useState} from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {Link} from "react-router-dom";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import EquipmentsListFilters from "app/admin/services/api/filters/EquipmentsListFilters.tsx";
import AdminEquipmentsSearchForm from "app/admin/features/equipment/AdminEquipmentsSearchForm.tsx";
import EquipmentsListTable from "app/admin/features/equipment/AdminEquipmentsListTable.tsx";

const AdminEquipmentsPage: React.FC = () => {
    const defaultFilters = new EquipmentsListFilters();
    const [filters, setFilters] = useState<EquipmentsListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)

    const handleEquipmentsSearch = (filtersFromForm: EquipmentsListFilters) => {
        setFilters({
            ...filters,
            ...filtersFromForm
        });

        setRefreshKey(prev => prev + 1);
    }

    return (
        <AdminLayout>
            <h2>
                Equipments list
            </h2>

            <div className={"margin-bottom-s"}>
                <AdminEquipmentsSearchForm defaultFilters={defaultFilters} callbackFunction={handleEquipmentsSearch} />
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={adminRoutes.equipment.create}>Create New Equipment</Link>
            </div>

            <div className={"float-left two-thirds-width"}>
                <EquipmentsListTable filters={filters} refreshKey={refreshKey} />
            </div>
        </AdminLayout>
    )
}

export default AdminEquipmentsPage;