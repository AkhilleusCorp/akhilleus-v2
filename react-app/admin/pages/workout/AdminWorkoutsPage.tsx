import React, {useState} from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import {Link} from "react-router-dom";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import AdminWorkoutsListFilters from "app/admin/services/api/filters/AdminWorkoutsListFilters.tsx";
import AdminWorkoutsSearchForm from "app/admin/features/workout/AdminWorkoutsSearchForm.tsx";
import WorkoutsListTable from "app/admin/features/workout/AdminWorkoutsListTable.tsx";

const AdminWorkoutsPage: React.FC = () => {
    const defaultFilters = new AdminWorkoutsListFilters();
    const [filters, setFilters] = useState<AdminWorkoutsListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)

    const handleWorkoutsSearch = (filtersFromForm: AdminWorkoutsListFilters) => {
        setFilters({
            ...filters,
            ...filtersFromForm
        });

        setRefreshKey(prev => prev + 1);
    }

    return (
        <AdminLayout>
            <h2>
                Workouts list
            </h2>

            <div className={"margin-bottom-s"}>
                <AdminWorkoutsSearchForm defaultFilters={defaultFilters} callbackFunction={handleWorkoutsSearch} />
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={adminRoutes.workout.create}>Create New Workout</Link>
            </div>

            <WorkoutsListTable filters={filters} refreshKey={refreshKey}/>
        </AdminLayout>
    )
}

export default AdminWorkoutsPage;