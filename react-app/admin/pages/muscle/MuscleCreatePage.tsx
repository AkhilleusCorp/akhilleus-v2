import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import AdminMuscleCreateForm from "app/admin/features/muscle/AdminMuscleCreateForm.tsx";

const MuscleCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new Muscle</h1>
            <div>
                <AdminMuscleCreateForm/>
            </div>
        </AdminLayout>
    );
}

export default MuscleCreatePage;