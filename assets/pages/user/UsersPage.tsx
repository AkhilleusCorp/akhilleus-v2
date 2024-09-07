import React from 'react';
import AdminLayout from "../../layouts/AdminLayout.tsx";
import UserListWidget from "../../widget/user/UserListWidget.tsx";

const UsersPage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Users Page</h1>
            <UserListWidget />
        </AdminLayout>
    );
}

export default UsersPage;