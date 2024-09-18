import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UserCreateForm from "../../widget/user/UseCreateForm.tsx";

const CreateUserPage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Create User Page</h1>
            <div>
                <UserCreateForm />
            </div>
        </AdminLayout>
    );
}

export default CreateUserPage;