import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import {Link} from "react-router-dom";
import routes from "../../infrastructure/router/routes-mapping.tsx";

const WorkoutsPage: React.FC = () => {
    return (
        <AdminLayout>
            <h2 className={"margin-bottom-s"}>
                Users list
            </h2>

            <div className={"margin-bottom-s"}>
                Filters
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={routes.workout.create}>Create New Workout</Link>
            </div>

            <div className={"float-left two-thirds-width"}>
                Workouts
            </div>
        </AdminLayout>
)
}

export default WorkoutsPage;