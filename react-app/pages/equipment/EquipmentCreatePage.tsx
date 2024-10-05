import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import EquipmentCreateForm from "../../features/equipment/EquipmentCreateForm.tsx";

const EquipmentCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new User</h1>
            <div>
                <EquipmentCreateForm/>
            </div>
        </AdminLayout>
    );
}

export default EquipmentCreatePage;