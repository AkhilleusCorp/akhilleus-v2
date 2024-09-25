import React, {useState} from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import {Link} from "react-router-dom";
import routes from "../../infrastructure/router/routes-mapping.tsx";
import WorkoutsListFilters from "../../filters/WorkoutsListFilters.tsx";
import WorkoutAPI from "../../api/WorkoutApi.tsx";
import WorkoutDTO from "../../dtos/WorkoutDTO.tsx";
import WorkoutDetailsCard from "../../widget/workout/WorkoutDetailsCard.tsx";
import WorkoutsSearchForm from "../../widget/workout/WorkoutsSearchForm.tsx";
import WorkoutsListTable from "../../widget/workout/WorkoutsListTable.tsx";

const WorkoutsPage: React.FC = () => {
    const defaultFilters: WorkoutsListFilters = { ids: null, name: null, statuses: null, limit: 25 };
    const [filters, setFilters] = useState<WorkoutsListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)
    const [workoutPreview, setUserPreview] = useState<WorkoutDTO|null>(null);

    const handleDisplayUserPreview = async (workoutId: number) => {
        const preview = await WorkoutAPI.getOneWorkout(String(workoutId));
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
            <h2 className={"margin-bottom-s"}>
                Workouts list
            </h2>

            <div className={"margin-bottom-s"}>
                <WorkoutsSearchForm defaultFilters={defaultFilters} callbackFunction={handleWorkoutsSearch} />
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={routes.workout.create}>Create New Workout</Link>
            </div>

            <div className={"float-left two-thirds-width"}>
                <WorkoutsListTable filters={filters} refreshKey={refreshKey} mainLinkClickCallback={handleDisplayUserPreview}/>
            </div>

            <div className={"float-left padding-left-m one-thirds-width "}>
                {workoutPreview && (
                    <WorkoutDetailsCard workout={workoutPreview} displayActions={true}/>
                )}
            </div>
        </AdminLayout>
    )
}

export default WorkoutsPage;