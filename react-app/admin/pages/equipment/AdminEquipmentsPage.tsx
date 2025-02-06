import React, {useState} from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {Link} from "react-router-dom";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import EquipmentsListFilters from "app/admin/services/api/filters/AdminEquipmentsListFilters.tsx";
import AdminEquipmentsSearchForm from "app/admin/features/equipment/AdminEquipmentsSearchForm.tsx";
import AdminEquipmentsListTable from "app/admin/features/equipment/AdminEquipmentsListTable.tsx";

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
                <Link to={adminRoutes.equipment.create}>Add New Equipment</Link>
            </div>

            <AdminEquipmentsListTable filters={filters} refreshKey={refreshKey} />
        </AdminLayout>
    )
}

export default AdminEquipmentsPage;