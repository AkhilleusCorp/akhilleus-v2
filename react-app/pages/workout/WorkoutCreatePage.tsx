import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import WorkoutCreateForm from "../../widget/workout/WorkoutCreateForm.tsx";

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