import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";
import AdminUserCreateForm from "app/admin/features/user/AdminUseCreateForm.tsx";

const UserCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new User</h1>
            <div>
                <AdminUserCreateForm />
            </div>
        </AdminLayout>
    );
}

export default UserCreatePage;