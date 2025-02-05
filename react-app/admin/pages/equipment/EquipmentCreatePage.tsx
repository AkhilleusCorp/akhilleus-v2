import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import AdminEquipmentCreateForm from "app/admin/features/equipment/AdminEquipmentCreateForm.tsx";

const EquipmentCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new Equipment</h1>
            <div>
                <AdminEquipmentCreateForm/>
            </div>
        </AdminLayout>
    );
}

export default EquipmentCreatePage;