import React from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import UserCreateForm from "app/features/user/UseCreateForm.tsx";

const UserCreatePage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Add new User</h1>
            <div>
                <UserCreateForm />
            </div>
        </AdminLayout>
    );
}

export default UserCreatePage;