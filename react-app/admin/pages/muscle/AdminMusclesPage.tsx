import React, {useState} from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {Link} from "react-router-dom";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import MusclesListFilters from "app/admin/services/api/filters/MusclesListFilters.tsx";
import AdminMusclesSearchForm from "app/admin/features/muscle/AdminMusclesSearchForm.tsx";
import AdminMusclesListTable from "app/admin/features/muscle/AdminMusclesListTable.tsx";

const AdminMusclesPage: React.FC = () => {
    const defaultFilters = new MusclesListFilters();
    const [filters, setFilters] = useState<MusclesListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)

    const handleMusclesSearch = (filtersFromForm: MusclesListFilters) => {
        setFilters({
            ...filters,
            ...filtersFromForm
        });

        setRefreshKey(prev => prev + 1);
    }

    return (
        <AdminLayout>
            <h2>
                Muscles list
            </h2>

            <div className={"margin-bottom-s"}>
                <AdminMusclesSearchForm defaultFilters={defaultFilters} callbackFunction={handleMusclesSearch} />
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={adminRoutes.muscle.create}>Add New Muscle</Link>
            </div>

            <AdminMusclesListTable filters={filters} refreshKey={refreshKey} />
        </AdminLayout>
    )
}

export default AdminMusclesPage;