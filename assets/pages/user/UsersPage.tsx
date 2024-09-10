import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UsersListWidget from "../../widget/user/UsersListWidget.tsx";

const UsersPage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>Users Page</h1>
            <UsersListWidget />
        </AdminLayout>
    );
}

export default UsersPage;