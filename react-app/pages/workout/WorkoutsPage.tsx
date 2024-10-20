import React, {useState} from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import {Link} from "react-router-dom";
import websiteRoutes from "app/services/router/websiteRoutes.tsx";
import WorkoutsListFilters from "app/services/api/filters/WorkoutsListFilters.tsx";
import WorkoutDTO from "app/services/api/dtos/WorkoutDTO.tsx";
import WorkoutPreviewCard from "app/features/workout/WorkoutPreviewCard.tsx";
import WorkoutsSearchForm from "app/features/workout/WorkoutsSearchForm.tsx";
import WorkoutsListTable from "app/features/workout/WorkoutsListTable.tsx";
import WorkoutApiGateway from "app/services/api/gateway/WorkoutApiGateway.tsx";

const WorkoutsPage: React.FC = () => {
    const defaultFilters = new WorkoutsListFilters();
    const [filters, setFilters] = useState<WorkoutsListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)
    const [workoutPreview, setUserPreview] = useState<WorkoutDTO|null>(null);

    const handleDisplayUserPreview = async (workoutId: number) => {
        const preview = await WorkoutApiGateway.getOneWorkout(String(workoutId));
        setUserPreview(preview);
    }

    const handleWorkoutsSearch = (filtersFromForm: WorkoutsListFilters) => {
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
                <WorkoutsSearchForm defaultFilters={defaultFilters} callbackFunction={handleWorkoutsSearch} />
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={websiteRoutes.workout.create}>Create New Workout</Link>
            </div>

            <div className={"float-left two-thirds-width"}>
                <WorkoutsListTable filters={filters} refreshKey={refreshKey} mainLinkClickCallback={handleDisplayUserPreview}/>
            </div>

            <div className={"float-left padding-left-m one-thirds-width"}>
                {workoutPreview && (
                    <WorkoutPreviewCard workout={workoutPreview} displayReadActions={true} displayWriteActions={false}/>
                )}
            </div>
        </AdminLayout>
    )
}

export default WorkoutsPage;