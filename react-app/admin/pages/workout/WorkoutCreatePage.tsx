import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import WorkoutCreateForm from "app/admin/features/workout/WorkoutCreateForm.tsx";

const WorkoutCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new Workout</h1>
            <div>
                <WorkoutCreateForm/>
            </div>
        </AdminLayout>
)
}

export default WorkoutCreatePage;