import React from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import EquipmentCreateForm from "app/features/equipment/EquipmentCreateForm.tsx";

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