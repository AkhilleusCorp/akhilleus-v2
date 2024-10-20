import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import EquipmentCreateForm from "app/admin/features/equipment/EquipmentCreateForm.tsx";

const EquipmentCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new Equipment</h1>
            <div>
                <EquipmentCreateForm/>
            </div>
        </AdminLayout>
    );
}

export default EquipmentCreatePage;