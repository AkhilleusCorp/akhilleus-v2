import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import MuscleCreateForm from "app/admin/features/muscle/MuscleCreateForm.tsx";

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