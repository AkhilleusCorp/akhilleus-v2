import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import MuscleCreateForm from "../../features/workout/MuscleCreateForm.tsx";

const MuscleCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new Muscle</h1>
            <div>
                <MuscleCreateForm/>
            </div>
        </AdminLayout>
    );
}

export default MuscleCreatePage;