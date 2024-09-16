import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UserCreateFormWidget from "../../widget/user/UseCreateFormWidget.tsx";

const CreateUserPage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Create User Page</h1>
            <div>
                <UserCreateFormWidget />
            </div>
        </AdminLayout>
    );
}

export default CreateUserPage;