import React from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import MovementCreateForm from "app/features/movement/MovementCreateForm.tsx";

const MovementCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new Movement</h1>
            <div>
                <MovementCreateForm/>
            </div>
        </AdminLayout>
    );
}

export default MovementCreatePage;