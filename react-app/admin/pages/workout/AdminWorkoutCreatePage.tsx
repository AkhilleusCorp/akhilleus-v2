import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import WorkoutCreateForm from "app/common/features/workout/WorkoutCreateForm.tsx";

const AdminWorkoutCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new Workout</h1>
            <div>
                <WorkoutCreateForm userType={'admin'}/>
            </div>
        </AdminLayout>
)
}

export default AdminWorkoutCreatePage;