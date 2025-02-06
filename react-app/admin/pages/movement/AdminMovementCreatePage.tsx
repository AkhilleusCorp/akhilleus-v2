import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import AdminMovementCreateForm from "app/admin/features/movement/AdminMovementCreateForm.tsx";

const AdminMovementCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new Movement</h1>
            <div>
                <AdminMovementCreateForm/>
            </div>
        </AdminLayout>
    );
}

export default AdminMovementCreatePage;