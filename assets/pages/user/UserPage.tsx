import React from 'react';
import AdminLayout from "../../layouts/AdminLayout.tsx";
import UserCardWidget from "../../widget/user/UserCardWidget.tsx";

const UserPage: React.FC = () => {
    return (
        <AdminLayout>
            <h1>User Page</h1>
            <UserCardWidget />
        </AdminLayout>
    );
}

export default UserPage;